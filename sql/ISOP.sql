/****** Object:  Table [dbo].[ISPR_Accion]    Script Date: 27/03/2018 16:12:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ISPR_Accion](
	[id_accion] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](100) NOT NULL,
	[alias] [varchar](100) NOT NULL,
	[activo] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_accion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_Pregunta]    Script Date: 27/03/2018 16:12:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ISPR_Pregunta](
	[id_pregunta] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](100) NOT NULL,
	[activo] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_pregunta] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_Rol]    Script Date: 27/03/2018 16:12:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ISPR_Rol](
	[id_rol] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](100) NOT NULL,
	[activo] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_rol] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_RolAccion]    Script Date: 27/03/2018 16:12:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ISPR_RolAccion](
	[id_rol] [int] NOT NULL,
	[id_accion] [int] NOT NULL,
	[modifica] [bit] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_rol] ASC,
	[id_accion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

CREATE TABLE [dbo].[ISPR_Empresa](
	[id_empresa] int identity primary key,
	[codigo_onapre] [varchar](50) NULL,
	[descripcion] [varchar](250) NOT NULL,
	[organismo] [varchar](250) NOT NULL,
	tipo_ente int default 1,
	activo bit default 1
)
GO

CREATE TABLE ISPR_Unidad (
	id_unidad int identity primary key,
	descripcion varchar(100) not null,
	principal bit not null default 0,
	responsable varchar(100) null,
	activo bit default 1
)
GO

CREATE TABLE ISPR_UnidadConexion (
	base_datos varchar(50) not null,
	usuario varchar(50) not null,
	clave varchar(255) not null,
	ip varchar(100) not null,
	puerto int not null default '1433',
	id_unidad int unique,
	activo bit default 1
)
GO

CREATE TABLE [dbo].[ISPR_Clasificacion](
	[id_clasificacion] int identity primary key,
	codigo varchar(50) null,
	[descripcion] [varchar](250) NOT NULL,
	[detalle] [varchar](4000) NOT NULL,
	nivel int not null default 1,
	padre int null default 1,
	activo bit default 1
)
GO

CREATE TABLE [dbo].[ISPR_Partida](
	id_partida varchar(15) primary key,
	[partida] [varchar](3) NOT NULL,
	[generica] [varchar](3) NOT NULL,
	[especifica] [varchar](3) NOT NULL,
	[subEspecifica] [varchar](3) NOT NULL,
	[denominacion] [varchar](4000) NOT NULL,
	[descripcion] [varchar](4000) NOT NULL,
	activo bit default 1,
	movimiento bit default 0
)
GO

CREATE TABLE [dbo].[ISPR_UPA](
	id_upa bigint IDENTITY primary key,
	id_partida [varchar](15) NOT NULL,
	denominacion_partida varchar(4000) null,
	id_clasificacion int NOT NULL,
	descripcion_clasificacion [varchar](250) NOT NULL,
	id_unidad int not null,
	[monto] [numeric](20, 4) NOT NULL default 0,
	[fecha] [datetime] NULL,
	[partida_origen] [varchar](15) NULL,
	asignacion smallint NOT NULL,
	tipo_operacion char(1) not null
)
GO
CREATE TABLE [dbo].[ISPR_Registro](
	id_registro bigint IDENTITY primary key,
	id_usuario int NOT NULL,
	[comentario] [text] NOT NULL,
	[fecha] [datetime] NOT NULL default GETDATE(),
	[ip] [varchar](50) NOT NULL,
	[estacion] [varchar](100),
	[tabla] [varchar](100),
)
GO
/****** Object:  Table [dbo].[ISPR_Usuario]    Script Date: 27/03/2018 16:12:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ISPR_Usuario](
	[id_usuario] [int] IDENTITY(1,1) NOT NULL,
	[usuario] [varchar](20) NOT NULL,
	[correo] [varchar](100) NOT NULL,
	[cedula] [varchar](15) NOT NULL,
	[clave] [varchar](100) NOT NULL,
	[nombre] [nvarchar](100) NOT NULL,
	[apellido] [varchar](100) NOT NULL,
	[sexo] [char](1) NOT NULL,
	[respuesta_seguridad] [varchar](1000) NULL,
	[fecha_registro] [datetime] NOT NULL,
	[telefono] [varchar](20) NULL,
	[activo] [bit] NOT NULL,
	[id_rol] [int] NOT NULL,
	[id_pregunta] [int] NULL,
	[id_unidad] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
UNIQUE NONCLUSTERED 
(
	[usuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[ISPR_Accion] ADD  DEFAULT ((1)) FOR [activo]
GO
ALTER TABLE [dbo].[ISPR_Pregunta] ADD  DEFAULT ((1)) FOR [activo]
GO
ALTER TABLE [dbo].[ISPR_Rol] ADD  DEFAULT ((1)) FOR [activo]
GO
ALTER TABLE [dbo].[ISPR_RolAccion] ADD  DEFAULT ((1)) FOR [modifica]
GO
ALTER TABLE [dbo].[ISPR_Usuario] ADD  DEFAULT ('M') FOR [sexo]
GO
ALTER TABLE [dbo].[ISPR_Usuario] ADD  DEFAULT (getdate()) FOR [fecha_registro]
GO
ALTER TABLE [dbo].[ISPR_Usuario] ADD  DEFAULT ((1)) FOR [activo]
GO
ALTER TABLE [dbo].[ISPR_RolAccion]  WITH CHECK ADD  CONSTRAINT [fk_prrol_accion01] FOREIGN KEY([id_rol])
REFERENCES [dbo].[ISPR_Rol] ([id_rol])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ISPR_RolAccion] CHECK CONSTRAINT [fk_prrol_accion01]
GO
ALTER TABLE [dbo].[ISPR_RolAccion]  WITH CHECK ADD  CONSTRAINT [fk_prrol_accion02] FOREIGN KEY([id_accion])
REFERENCES [dbo].[ISPR_Accion] ([id_accion])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ISPR_RolAccion] CHECK CONSTRAINT [fk_prrol_accion02]
GO
ALTER TABLE [dbo].[ISPR_Usuario]  WITH CHECK ADD  CONSTRAINT [fk_prusuario_pregunta] FOREIGN KEY([id_pregunta])
REFERENCES [dbo].[ISPR_Pregunta] ([id_pregunta])
GO
ALTER TABLE [dbo].[ISPR_Usuario] CHECK CONSTRAINT [fk_prusuario_pregunta]
GO
ALTER TABLE [dbo].[ISPR_Usuario]  WITH CHECK ADD  CONSTRAINT [fk_prusuario_rol] FOREIGN KEY([id_rol])
REFERENCES [dbo].[ISPR_Rol] ([id_rol])
GO
ALTER TABLE [dbo].[ISPR_Usuario] CHECK CONSTRAINT [fk_prusuario_rol]
GO
ALTER TABLE [dbo].[ISPR_Usuario]  WITH CHECK ADD  CONSTRAINT [fk_prusuario_unidad] FOREIGN KEY([id_unidad])
REFERENCES [dbo].[ISPR_Unidad] ([id_unidad])
GO
ALTER TABLE [dbo].[ISPR_Usuario] CHECK CONSTRAINT [fk_prusuario_unidad]
GO
ALTER TABLE [dbo].[ISPR_UnidadConexion]  WITH CHECK ADD  CONSTRAINT [fk_prunidadbd_unidad] FOREIGN KEY([id_unidad])
REFERENCES [dbo].[ISPR_Unidad] ([id_unidad])
GO
ALTER TABLE [dbo].[ISPR_UnidadConexion] CHECK CONSTRAINT [fk_prunidadbd_unidad]
GO

ALTER TABLE [dbo].[ISPR_UPA]  WITH CHECK ADD  CONSTRAINT [fk_prupa_partida] FOREIGN KEY([id_partida])
REFERENCES [dbo].[ISPR_Partida] ([id_partida]) ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[ISPR_UPA]  WITH CHECK ADD  CONSTRAINT [fk_prupa_clasificacion] FOREIGN KEY([id_clasificacion])
REFERENCES [dbo].[ISPR_Clasificacion] ([id_clasificacion]) 
GO
ALTER TABLE [dbo].[ISPR_Unidad]  WITH CHECK ADD  CONSTRAINT [fk_prupa_unidad] FOREIGN KEY([id_unidad])
REFERENCES [dbo].[ISPR_Unidad] ([id_unidad]) 
GO
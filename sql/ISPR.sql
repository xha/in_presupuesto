USE [AEPRESUPUESTO]
GO
/****** Object:  Table [dbo].[ISPR_Accion]    Script Date: 30/03/2018 21:34:24 ******/
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
/****** Object:  Table [dbo].[ISPR_Clasificacion]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[ISPR_Clasificacion](
	[id_clasificacion] [int] IDENTITY(1,1) NOT NULL,
	[codigo] [varchar](50) NULL,
	[descripcion] [varchar](500) NOT NULL,
	[detalle] [varchar](4000) NOT NULL,
	[nivel] [int] NOT NULL DEFAULT ((1)),
	[padre] [int] NULL DEFAULT ((1)),
	[activo] [bit] NULL DEFAULT ((1)),
PRIMARY KEY CLUSTERED 
(
	[id_clasificacion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_ClasificacionUnidad]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ISPR_ClasificacionUnidad](
	[id_clasificacion] [int] NOT NULL,
	[id_unidad] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_clasificacion] ASC,
	[id_unidad] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[ISPR_Empresa]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[ISPR_Empresa](
	[id_empresa] [int] IDENTITY(1,1) NOT NULL,
	[codigo_onapre] [varchar](50) NULL,
	[descripcion] [varchar](250) NOT NULL,
	[organismo] [varchar](250) NOT NULL,
	[tipo_ente] [int] NULL DEFAULT ((1)),
	[activo] [bit] NULL DEFAULT ((1)),
PRIMARY KEY CLUSTERED 
(
	[id_empresa] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_Partida]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[ISPR_Partida](
	[id_partida] [varchar](15) NOT NULL,
	[partida] [varchar](3) NOT NULL,
	[generica] [varchar](3) NOT NULL,
	[especifica] [varchar](3) NOT NULL,
	[subEspecifica] [varchar](3) NOT NULL,
	[denominacion] [varchar](500) NOT NULL,
	[descripcion] [varchar](4000) NOT NULL,
	[activo] [bit] NULL,
	[movimiento] [bit] NULL,
	[nivel] [tinyint] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_partida] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_Pregunta]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ISPR_Pregunta](
	[id_pregunta] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](100) NOT NULL,
	[activo] [bit] NOT NULL DEFAULT ((1)),
PRIMARY KEY CLUSTERED 
(
	[id_pregunta] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_Registro]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[ISPR_Registro](
	[id_registro] [bigint] IDENTITY(1,1) NOT NULL,
	[id_usuario] [int] NOT NULL,
	[comentario] [text] NOT NULL,
	[fecha] [datetime] NOT NULL,
	[ip] [varchar](50) NOT NULL,
	[estacion] [varchar](100) NULL,
	[tabla] [varchar](100) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_registro] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_Rol]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ISPR_Rol](
	[id_rol] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](100) NOT NULL,
	[activo] [bit] NOT NULL DEFAULT ((1)),
PRIMARY KEY CLUSTERED 
(
	[id_rol] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_RolAccion]    Script Date: 30/03/2018 21:34:25 ******/
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
/****** Object:  Table [dbo].[ISPR_Unidad]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[ISPR_Unidad](
	[id_unidad] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](100) NOT NULL,
	[responsable] [varchar](100) NULL,
	[activo] [bit] NULL DEFAULT ((1)),
	[nivel] [tinyint] NULL DEFAULT ((1)),
	[padre] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_unidad] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_UnidadConexion]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[ISPR_UnidadConexion](
	[base_datos] [varchar](50) NOT NULL,
	[usuario] [varchar](50) NOT NULL,
	[clave] [varchar](255) NOT NULL,
	[ip] [varchar](100) NOT NULL,
	[puerto] [int] NOT NULL,
	[id_unidad] [int] NULL,
	[activo] [bit] NULL,
UNIQUE NONCLUSTERED 
(
	[id_unidad] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_UPA]    Script Date: 30/03/2018 21:34:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING OFF
GO
CREATE TABLE [dbo].[ISPR_UPA](
	[id_upa] [bigint] IDENTITY(1,1) NOT NULL,
	[id_partida] [varchar](15) NOT NULL,
	[denominacion_partida] [varchar](500) NULL,
	[id_clasificacion] [int] NOT NULL,
	[descripcion_clasificacion] [varchar](500) NOT NULL,
	[observacion] [varchar](500) NOT NULL,
	[id_unidad] [int] NOT NULL,
	[monto] [numeric](20, 4) NOT NULL,
	[fecha] [datetime] NULL,
	[partida_origen] [varchar](15) NULL,
	[asignacion] [smallint] NOT NULL,
	[tipo_operacion] [char](1) NOT NULL,
	[verificado] [bit] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_upa] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ISPR_Usuario]    Script Date: 30/03/2018 21:34:25 ******/
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
	[sexo] [char](1) NOT NULL DEFAULT ('M'),
	[respuesta_seguridad] [varchar](1000) NULL,
	[fecha_registro] [datetime] NOT NULL DEFAULT (getdate()),
	[telefono] [varchar](20) NULL,
	[activo] [bit] NOT NULL DEFAULT ((1)),
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
ALTER TABLE [dbo].[ISPR_Partida] ADD  DEFAULT ((1)) FOR [activo]
GO
ALTER TABLE [dbo].[ISPR_Partida] ADD  DEFAULT ((0)) FOR [movimiento]
GO
ALTER TABLE [dbo].[ISPR_Partida] ADD  DEFAULT ((1)) FOR [nivel]
GO
ALTER TABLE [dbo].[ISPR_Registro] ADD  DEFAULT (getdate()) FOR [fecha]
GO
ALTER TABLE [dbo].[ISPR_RolAccion] ADD  DEFAULT ((1)) FOR [modifica]
GO
ALTER TABLE [dbo].[ISPR_UnidadConexion] ADD  DEFAULT ('1433') FOR [puerto]
GO
ALTER TABLE [dbo].[ISPR_UnidadConexion] ADD  DEFAULT ((1)) FOR [activo]
GO
ALTER TABLE [dbo].[ISPR_UPA] ADD  DEFAULT ((0)) FOR [monto]
GO
ALTER TABLE [dbo].[ISPR_UPA] ADD  DEFAULT ((0)) FOR [verificado]
GO
ALTER TABLE [dbo].[ISPR_ClasificacionUnidad]  WITH CHECK ADD  CONSTRAINT [fk_Clasificacionunidad0] FOREIGN KEY([id_clasificacion])
REFERENCES [dbo].[ISPR_Clasificacion] ([id_clasificacion])
GO
ALTER TABLE [dbo].[ISPR_ClasificacionUnidad] CHECK CONSTRAINT [fk_Clasificacionunidad0]
GO
ALTER TABLE [dbo].[ISPR_ClasificacionUnidad]  WITH CHECK ADD  CONSTRAINT [fk_Clasificacionunidad1] FOREIGN KEY([id_unidad])
REFERENCES [dbo].[ISPR_Unidad] ([id_unidad])
GO
ALTER TABLE [dbo].[ISPR_ClasificacionUnidad] CHECK CONSTRAINT [fk_Clasificacionunidad1]
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
ALTER TABLE [dbo].[ISPR_Unidad]  WITH CHECK ADD  CONSTRAINT [fk_prupa_unidad] FOREIGN KEY([id_unidad])
REFERENCES [dbo].[ISPR_Unidad] ([id_unidad])
GO
ALTER TABLE [dbo].[ISPR_Unidad] CHECK CONSTRAINT [fk_prupa_unidad]
GO
ALTER TABLE [dbo].[ISPR_UnidadConexion]  WITH CHECK ADD  CONSTRAINT [fk_prunidadbd_unidad] FOREIGN KEY([id_unidad])
REFERENCES [dbo].[ISPR_Unidad] ([id_unidad])
GO
ALTER TABLE [dbo].[ISPR_UnidadConexion] CHECK CONSTRAINT [fk_prunidadbd_unidad]
GO
ALTER TABLE [dbo].[ISPR_UPA]  WITH CHECK ADD  CONSTRAINT [fk_prupa_clasificacion] FOREIGN KEY([id_clasificacion])
REFERENCES [dbo].[ISPR_Clasificacion] ([id_clasificacion])
GO
ALTER TABLE [dbo].[ISPR_UPA] CHECK CONSTRAINT [fk_prupa_clasificacion]
GO
ALTER TABLE [dbo].[ISPR_UPA]  WITH CHECK ADD  CONSTRAINT [fk_prupa_partida] FOREIGN KEY([id_partida])
REFERENCES [dbo].[ISPR_Partida] ([id_partida])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[ISPR_UPA] CHECK CONSTRAINT [fk_prupa_partida]
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

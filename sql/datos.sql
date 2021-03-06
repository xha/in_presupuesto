SET IDENTITY_INSERT [dbo].[ISPR_Rol] ON 
INSERT [dbo].[ISPR_Rol] ([id_rol], [descripcion], [activo]) VALUES (1, N'En Espera', 1)
INSERT [dbo].[ISPR_Rol] ([id_rol], [descripcion], [activo]) VALUES (2, N'Usuario', 1)
INSERT [dbo].[ISPR_Rol] ([id_rol], [descripcion], [activo]) VALUES (3, N'Administrador', 1)
SET IDENTITY_INSERT [dbo].[ISPR_Rol] OFF

SET IDENTITY_INSERT [dbo].[ISPR_Pregunta] ON 
INSERT [dbo].[ISPR_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (1, N'Lugar de Nacimiento', 1)
INSERT [dbo].[ISPR_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (2, N'Segundo nombre de su Padre', 1)
INSERT [dbo].[ISPR_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (3, N'Segundo nombre de su Madre', 1)
INSERT [dbo].[ISPR_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (4, N'Héroe de infancia', 1)
INSERT [dbo].[ISPR_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (5, N'Lugar de Luna de miel', 1)
SET IDENTITY_INSERT [dbo].[ISPR_Pregunta] OFF

SET IDENTITY_INSERT [dbo].[ISPR_Unidad] ON 
INSERT [dbo].[ISPR_Unidad] ([id_unidad], [descripcion], [activo]) VALUES (1, 'Caracas', 1)
SET IDENTITY_INSERT [dbo].[ISPR_Unidad] OFF

SET IDENTITY_INSERT [dbo].[ISPR_Clasificacion] ON 
INSERT [dbo].[ISPR_Clasificacion] ([id_clasificacion], [codigo],[descripcion], [detalle], [nivel], [padre], [activo]) VALUES (1, 'AC', 'Acción Centralizada', 'AC', 1, 0, 1);
INSERT [dbo].[ISPR_Clasificacion] ([id_clasificacion], [codigo],[descripcion], [detalle], [nivel], [padre], [activo]) VALUES (2, 'PR', 'Proyecto', 'PR', 1, 0, 1);
SET IDENTITY_INSERT [dbo].[ISPR_Clasificacion] OFF

SET IDENTITY_INSERT [dbo].[ISPR_Empresa] ON 
INSERT [dbo].[ISPR_Empresa] ([id_empresa], [codigo_onapre], descripcion, organismo, tipo_ente, [activo]) VALUES (1, '0', 'EMPRESA PRUEBA', 'MINISTERIO', 1, 1)
SET IDENTITY_INSERT [dbo].[ISPR_Empresa] OFF

SET IDENTITY_INSERT [dbo].[ISPR_Usuario] ON 
INSERT [dbo].[ISPR_Usuario] ([id_usuario], [usuario], [correo], [cedula], [clave], [nombre], [apellido], [sexo], [respuesta_seguridad], [telefono], [activo], [id_rol], [id_pregunta], [id_unidad]) VALUES (1, N'001', N'nada@nada.com', N'123456', N'9df3bb42df815f39041a621f7282a475', N'Innova', N'Administrador', N'M', N'CCS', NULL, 1, 3, 1, 1)
SET IDENTITY_INSERT [dbo].[ISPR_Usuario] OFF

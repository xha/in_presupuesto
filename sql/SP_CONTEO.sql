SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[SP_CONTEO] (
	@prm_FechaIni datetime 
	,@prm_FechaFin datetime 
)
AS 
BEGIN
	SET @prm_FechaIni = @prm_FechaIni + ' 00:00:00'
	SET @prm_FechaFin = @prm_FechaFin + ' 23:59:59'
	SELECT 
		Venta,
		Devolucion_Venta,
		Presupuesto,
		Pedido,
		Compra,
		Devolucion_Compra,
		Orden,
		Cotizacion
	FROM (--VENTA
	SELECT count(NumeroD) as Venta FROM SAFACT WHERE 
	TipoFac='A' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as F,(
	SELECT count(NumeroD) as Devolucion_Venta FROM SAFACT WHERE 
	TipoFac='B' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as DF,(
	SELECT count(NumeroD) as Presupuesto FROM SAFACT WHERE 
	TipoFac='F' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as PF,(
	SELECT count(NumeroD) as Pedido FROM SAFACT WHERE 
	TipoFac='E' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as PeF,(--COMPRA
	SELECT count(NumeroD) as Compra FROM SACOMP WHERE 
	TipoCom='H' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as C,(
	SELECT count(NumeroD) as Devolucion_Compra FROM SACOMP WHERE 
	TipoCom='I' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as DC,(
	SELECT count(NumeroD) as Orden FROM SACOMP WHERE 
	TipoCom='L' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as OC,(
	SELECT count(NumeroD) as Cotizacion FROM SACOMP WHERE 
	TipoCom='S' and FechaE between @prm_FechaIni and @prm_FechaFin
	) as CC
END;
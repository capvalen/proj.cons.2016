select * from cliente
left join citaDetalle on citaDetalle.IdHistoriaClinica = cliente.IdCliente

--cliente e historia clinica =30447
--cita = left: 35491, inner: 35491
--cliente y cita = 46845
select * from  dbo.CitaDetalle


-- Para calcular los duplicados
SELECT IdHistoriaClinica, count(*)
FROM dbo.CitaDetalle
GROUP BY IdHistoriaClinica
HAVING count(*) > 1


-- Seleccione los valores de las claves duplicadas e inclúyalas en otra tabla temporal
select IdHistoriaClinica,col3= count(*)
INTO holdkey1
from  dbo.CitaDetalle
group by IdHistoriaClinica
HAVING count(*)>1


--Seleccione las filas duplicadas e inclúyalas en una tabla contenedora, eliminando los duplicados en el mismo proceso.
SELECT DISTINCT CitaDetalle.IdHistoriaClinica
INTO holddups2
FROM CitaDetalle, holdkey1
WHERE CitaDetalle.IdHistoriaClinica = holdkey1.IdHistoriaClinica
AND CitaDetalle.IdHistoriaClinica = holdkey1.IdHistoriaClinica


--En este momento, en la tabla holddups tendremos todas las filas unicas.
SELECT IdHistoriaClinica,  count(*)
FROM holddups2
GROUP BY IdHistoriaClinica

--Elimine las filas duplicadas en la tabla original.
DELETE CitaDetalle
FROM CitaDetalle, holdkey1
WHERE CitaDetalle.IdHistoriaClinica = holdkey1.IdHistoriaClinica

--Incluimos las filas unicas en la tabla original.
INSERT CitaDetalle SELECT * FROM holddups2
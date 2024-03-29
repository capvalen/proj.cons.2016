/****** Script para el comando SelectTopNRows de SSMS  ******/
SELECT [IdCita]
      ,[IdCliente]
      , DATEPART (minute,FechaCita) AS Minutos
      , CONVERT(char(8), FechaCita, 108) AS [hh:mm:ss]
      ,[HoraCita]
      ,[IdUsuarioRegistro]
      ,[FechaRegistro]
      ,[IdUsuarioModificacion]
      ,[FechaModificacion]
      ,[IdTipoCita]
      ,[IdProcedimiento]
  FROM [DBConsultorio].[dbo].[Cita]
   --WHERE IdCita=34355
  where [FechaCita] >=getdate()
  order by FechaCita asc
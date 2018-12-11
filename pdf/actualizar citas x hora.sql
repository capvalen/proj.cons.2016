UPDATE [DBConsultorio].[dbo].[Cita]
   SET [FechaCita] = CAST( '2016-01-08 09:20:00' as smalldatetime)
      ,[HoraCita] = CAST('2016-01-08 09:20:00' as smalldatetime)

 WHERE IdCita=35503
GO


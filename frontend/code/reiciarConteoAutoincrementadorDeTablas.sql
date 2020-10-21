--Reiniciar la tabla y con ello el auto incremental / sequence ELIMINANDO LOS REGISTROS
TRUNCATE TABLE sc.estado RESTART IDENTITY CASCADE

-- FORZAR TIPO DE DATO
ALTER TABLE sc.equipo
ALTER COLUMN entregado
TYPE integer USING CAST(entregado AS character varying);

--Reiniciar auto incremental / sequence sin eliminar la tabla
ALTER SEQUENCE campo_id_seq RESTART WITH 1

-- AÑADIR LLAVES PRIMARIAS
ALTER TABLE ONLY sc.auditoria
ADD CONSTRAINT idaudi
PRIMARY KEY(idaudi);

-- AÑADIR LLAVES FORANEAS
ALTER TABLE ONLY sc.insteduc
ADD CONSTRAINT idrgesta
FOREIGN KEY (idrgesta) REFERENCES sc.regestado(idrgesta);

-- AÑADIR COLUMNA
ALTER TABLE sc.estudiante ADD COLUMN iduser integer;

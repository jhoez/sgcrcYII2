CREATE TABLE public.auth_rule
(
  name character varying(64) NOT NULL,
  data bytea,
  created_at integer,
  updated_at integer,
  CONSTRAINT auth_rule_pkey PRIMARY KEY (name)
);

CREATE TABLE public.auth_item
(
  name character varying(64) NOT NULL,
  type smallint NOT NULL,
  description text,
  rule_name character varying(64),
  data bytea,
  created_at integer,
  updated_at integer,
  CONSTRAINT auth_item_pkey PRIMARY KEY (name),
  CONSTRAINT auth_item_rule_name_fkey FOREIGN KEY (rule_name)
      REFERENCES public.auth_rule (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE public.auth_item_child
(
  parent character varying(64) NOT NULL,
  child character varying(64) NOT NULL,
  CONSTRAINT auth_item_child_pkey PRIMARY KEY (parent, child),
  CONSTRAINT auth_item_child_child_fkey FOREIGN KEY (child)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT auth_item_child_parent_fkey FOREIGN KEY (parent)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE public.auth_assignment
(
  item_name character varying(64) NOT NULL,
  user_id character varying(64) NOT NULL,
  created_at integer,
  CONSTRAINT auth_assignment_pkey PRIMARY KEY (item_name, user_id),
  CONSTRAINT auth_assignment_item_name_fkey FOREIGN KEY (item_name)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE sc.estado
(
  idesta serial NOT NULL,
  nombest character varying(30),
  CONSTRAINT idesta PRIMARY KEY (idesta)
);

CREATE TABLE sc.municipio
(
  idmunc serial NOT NULL,
  municipio character varying(255),
  idesta integer,
  CONSTRAINT idmunc PRIMARY KEY (idmunc),
  CONSTRAINT idesta FOREIGN KEY (idesta)
      REFERENCES sc.estado (idesta) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.parroquia
(
  idpar serial NOT NULL,
  parroquia character varying(255),
  idmunc integer,
  CONSTRAINT idpar PRIMARY KEY (idpar),
  CONSTRAINT idmunc FOREIGN KEY (idmunc)
      REFERENCES sc.municipio (idmunc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.insteduc
(
  idinst serial NOT NULL,
  nombinst character varying(255),
  CONSTRAINT idinst PRIMARY KEY (idinst)
);

CREATE TABLE sc.sedeciat
(
  idciat serial NOT NULL,
  sede character varying(255),
  CONSTRAINT idciat PRIMARY KEY (idciat)
);

CREATE TABLE sc.representante
(
  idrep serial NOT NULL,
  cedula character varying(8),
  nombre character varying(50),
  telf character varying(12),
  docente character varying(1) DEFAULT 0,
  idciat integer,
  idinst integer,
  fkuser integer,
  CONSTRAINT idrep PRIMARY KEY (idrep),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.usuario (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idciat FOREIGN KEY (idciat)
      REFERENCES sc.sedeciat (idciat) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idinst FOREIGN KEY (idinst)
      REFERENCES sc.insteduc (idinst) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.estudiante
(
  idestu serial NOT NULL,
  nombestu character varying(255),
  idrep integer,
  idinst integer,
  CONSTRAINT idestu PRIMARY KEY (idestu),
  CONSTRAINT idinst FOREIGN KEY (idinst)
      REFERENCES sc.insteduc (idinst) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idrep FOREIGN KEY (idrep)
      REFERENCES sc.representante (idrep) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.niveleduc
(
  idniv serial NOT NULL,
  nivel character varying(20),
  graduado character varying(1) DEFAULT 0,
  idestu integer,
  CONSTRAINT idniv PRIMARY KEY (idniv),
  CONSTRAINT idestu FOREIGN KEY (idestu)
      REFERENCES sc.estudiante (idestu) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.direcuser
(
  iddiruser serial NOT NULL,
  idfkesta integer,
  idfkmunc integer,
  idfkpar integer,
  idfkciat integer,
  idfkinst integer,
  idfkrep integer,
  CONSTRAINT iddiruser PRIMARY KEY (iddiruser),
  CONSTRAINT idfkesta FOREIGN KEY (idfkesta)
      REFERENCES sc.estado (idesta) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkmunc FOREIGN KEY (idfkmunc)
      REFERENCES sc.municipio (idmunc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkpar FOREIGN KEY (idfkpar)
      REFERENCES sc.parroquia (idpar) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkciat FOREIGN KEY (idfkciat)
      REFERENCES sc.sedeciat (idciat) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkinst FOREIGN KEY (idfkinst)
      REFERENCES sc.insteduc (idinst) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkrep FOREIGN KEY (idfkrep)
      REFERENCES sc.representante (idrep) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.equipo
(
  ideq serial NOT NULL,
  eqserial character varying(125),
  frecepcion date,
  fentrega date,
  eqversion character varying(6),
  eqstatus character varying(11),
  idrep integer,
  diagnostico character varying(500),
  observacion character varying(500),
  status character varying(1) DEFAULT 0,
  CONSTRAINT ideq PRIMARY KEY (ideq),
  CONSTRAINT idrep FOREIGN KEY (idrep)
      REFERENCES sc.representante (idrep) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fcarga
(
  idcarg serial NOT NULL,
  fcarg character varying(255),
  ideq integer,
  CONSTRAINT idcarg PRIMARY KEY (idcarg),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fgeneral
(
  idgen serial NOT NULL,
  fgen character varying(255),
  ideq integer,
  CONSTRAINT idgen PRIMARY KEY (idgen),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fpantalla
(
  idpant serial NOT NULL,
  fpant character varying(255),
  ideq integer,
  CONSTRAINT idpant PRIMARY KEY (idpant),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fsoftware
(
  idsoft serial NOT NULL,
  fsoft character varying(255),
  ideq integer,
  CONSTRAINT idsoft PRIMARY KEY (idsoft),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.ftarjetamadre
(
  idtarj serial NOT NULL,
  ftarj character varying(255),
  ideq integer,
  CONSTRAINT idtarj PRIMARY KEY (idtarj),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fteclado
(
  idtec serial NOT NULL,
  ftec character varying(255),
  ideq integer,
  CONSTRAINT idtec PRIMARY KEY (idtec),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.imagen
(
  idimag serial NOT NULL,
  nombimg character varying(50) DEFAULT 'vacio'::character varying,
  extension character varying(5) DEFAULT 'vacio'::character varying,
  ruta character varying(255) DEFAULT 'vacio'::character varying,
  tamanio character varying(50) DEFAULT 0,
  tipoimg character varying(7),
  fkuser integer,
  CONSTRAINT idimag PRIMARY KEY (idimag),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.usuario (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.libros
(
  idlib serial NOT NULL,
  nomblib character varying(255),
  extension character varying(5),
  ruta character varying(255),
  coleccion character varying(255),
  nivel character varying(11),
  tamanio character varying(50),
  idfkimag integer,
  CONSTRAINT idlib PRIMARY KEY (idlib),
  CONSTRAINT idfkimag FOREIGN KEY (idfkimag)
      REFERENCES sc.imagen (idimag) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.formato
(
  idf serial NOT NULL,
  opcion character varying(255),
  nombf character varying(255),
  extens character varying(5),
  ruta character varying(255),
  tamanio character varying(50),
  status character varying(1),
  create_at date,
  statusacta integer,
  fkuser integer,
  CONSTRAINT idf PRIMARY KEY (idf),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.usuario (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.proyecto
(
  idpro serial NOT NULL,
  nombpro character varying(255),
  creador character varying(50),
  colaboracion character varying(255),
  descripcion character varying(500),
  create_at date,
  update_at date,
  fkuser integer,
  CONSTRAINT idpro PRIMARY KEY (idpro),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.usuario (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.multimedia
(
  idmult serial NOT NULL,
  nombmult character varying(255),
  extension character varying(5),
  tipomult character varying(5),
  tamanio character varying(20),
  ruta character varying(255),
  fkidpro integer,
  CONSTRAINT idmult PRIMARY KEY (idmult),
  CONSTRAINT fkidpro FOREIGN KEY (fkidpro)
      REFERENCES sc.proyecto (idpro) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.realaum
(
  idra serial NOT NULL,
  nra character varying(255),
  exten character varying(5),
  ruta character varying(255),
  fk_pro integer,
  fkimag integer,
  CONSTRAINT idra PRIMARY KEY (idra),
  CONSTRAINT fk_pro FOREIGN KEY (fk_pro)
      REFERENCES sc.proyecto (idpro) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fkimag FOREIGN KEY (fkimag)
      REFERENCES sc.imagen (idimag) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.asistencia
(
  idasis serial NOT NULL,
  fkuser integer,
  fecha date,
  horain time without time zone,
  horaout time without time zone,
  observacion text,
  CONSTRAINT idasis PRIMARY KEY (idasis),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.usuario (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

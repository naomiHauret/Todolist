CREATE TABLE prjweb.user(
  nomuser text NOT NULL,
  passworduser text NOT NULL,
  id serial NOT NULL,
  mailuser text NOT NULL,
  CONSTRAINT user_pkey PRIMARY KEY (id),
  CONSTRAINT user_mailuser_key UNIQUE (mailuser)
);

CREATE TABLE prjweb.task(
  idtask serial NOT NULL,
  iduser integer NOT NULL,
  intitule text NOT NULL,
  priorite integer,
  CONSTRAINT task_pkey PRIMARY KEY (idtask),
  CONSTRAINT task_iduser_fkey FOREIGN KEY (iduser)
      REFERENCES prjweb."user" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);
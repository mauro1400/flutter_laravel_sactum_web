z
DROP SEQUENCE IF EXISTS "public"."apoderados_id_apoderado_seq";
CREATE SEQUENCE "public"."apoderados_id_apoderado_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for chofers_id_chofer_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."chofers_id_chofer_seq";
CREATE SEQUENCE "public"."chofers_id_chofer_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for estados_id_estado_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."estados_id_estado_seq";
CREATE SEQUENCE "public"."estados_id_estado_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for estudiante_asistencias_id_estudiante_asistencia_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."estudiante_asistencias_id_estudiante_asistencia_seq";
CREATE SEQUENCE "public"."estudiante_asistencias_id_estudiante_asistencia_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for estudiante_transportes_id_estudiante_transporte_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."estudiante_transportes_id_estudiante_transporte_seq";
CREATE SEQUENCE "public"."estudiante_transportes_id_estudiante_transporte_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for estudiantes_id_estudiante_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."estudiantes_id_estudiante_seq";
CREATE SEQUENCE "public"."estudiantes_id_estudiante_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for failed_jobs_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."failed_jobs_id_seq";
CREATE SEQUENCE "public"."failed_jobs_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for gps_registros_id_gps_registro_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."gps_registros_id_gps_registro_seq";
CREATE SEQUENCE "public"."gps_registros_id_gps_registro_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for migrations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."migrations_id_seq";
CREATE SEQUENCE "public"."migrations_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for model_has_permissions_permission_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."model_has_permissions_permission_id_seq";
CREATE SEQUENCE "public"."model_has_permissions_permission_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for model_has_roles_role_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."model_has_roles_role_id_seq";
CREATE SEQUENCE "public"."model_has_roles_role_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for permissions_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."permissions_id_seq";
CREATE SEQUENCE "public"."permissions_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for personal_access_tokens_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."personal_access_tokens_id_seq";
CREATE SEQUENCE "public"."personal_access_tokens_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for personas_id_persona_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."personas_id_persona_seq";
CREATE SEQUENCE "public"."personas_id_persona_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for roles_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."roles_id_seq";
CREATE SEQUENCE "public"."roles_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for transportes_id_transporte_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."transportes_id_transporte_seq";
CREATE SEQUENCE "public"."transportes_id_transporte_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_id_seq";
CREATE SEQUENCE "public"."users_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for apoderados
-- ----------------------------
DROP TABLE IF EXISTS "public"."apoderados";
CREATE TABLE "public"."apoderados" (
  "id_apoderado" int4 NOT NULL DEFAULT nextval('apoderados_id_apoderado_seq'::regclass),
  "id_persona" int4 NOT NULL,
  "id_estudiante" int4 NOT NULL,
  "celular" text COLLATE "pg_catalog"."default",
  "pin" text COLLATE "pg_catalog"."default" DEFAULT '0000'::text,
  "estado" int4 DEFAULT 1,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of apoderados
-- ----------------------------

-- ----------------------------
-- Table structure for chofers
-- ----------------------------
DROP TABLE IF EXISTS "public"."chofers";
CREATE TABLE "public"."chofers" (
  "id_chofer" int4 NOT NULL DEFAULT nextval('chofers_id_chofer_seq'::regclass),
  "id_persona" int4 NOT NULL,
  "celular" text COLLATE "pg_catalog"."default",
  "pin" text COLLATE "pg_catalog"."default" DEFAULT '0000'::text,
  "estado" int4 DEFAULT 1,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of chofers
-- ----------------------------

-- ----------------------------
-- Table structure for estados
-- ----------------------------
DROP TABLE IF EXISTS "public"."estados";
CREATE TABLE "public"."estados" (
  "id_estado" int4 NOT NULL DEFAULT nextval('estados_id_estado_seq'::regclass),
  "descripcion" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of estados
-- ----------------------------

-- ----------------------------
-- Table structure for estudiante_asistencias
-- ----------------------------
DROP TABLE IF EXISTS "public"."estudiante_asistencias";
CREATE TABLE "public"."estudiante_asistencias" (
  "id_estudiante_asistencia" int4 NOT NULL DEFAULT nextval('estudiante_asistencias_id_estudiante_asistencia_seq'::regclass),
  "id_estudiante_transporte" int4 NOT NULL,
  "id_estado" int4 NOT NULL,
  "mensaje_padre" int4 DEFAULT 0,
  "estado" int4 DEFAULT 1,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of estudiante_asistencias
-- ----------------------------

-- ----------------------------
-- Table structure for estudiante_transportes
-- ----------------------------
DROP TABLE IF EXISTS "public"."estudiante_transportes";
CREATE TABLE "public"."estudiante_transportes" (
  "id_estudiante_transporte" int4 NOT NULL DEFAULT nextval('estudiante_transportes_id_estudiante_transporte_seq'::regclass),
  "id_estudiante" int4 NOT NULL,
  "id_transporte" int4 NOT NULL,
  "id_estado" int4 NOT NULL,
  "fecha_inicio" timestamp(6),
  "fecha_final" timestamp(6),
  "estado" int4 DEFAULT 1,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of estudiante_transportes
-- ----------------------------

-- ----------------------------
-- Table structure for estudiantes
-- ----------------------------
DROP TABLE IF EXISTS "public"."estudiantes";
CREATE TABLE "public"."estudiantes" (
  "id_estudiante" int4 NOT NULL DEFAULT nextval('estudiantes_id_estudiante_seq'::regclass),
  "id_persona" int4,
  "grado" text COLLATE "pg_catalog"."default",
  "estado" int4 DEFAULT 1,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of estudiantes
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS "public"."failed_jobs";
CREATE TABLE "public"."failed_jobs" (
  "id" int4 NOT NULL DEFAULT nextval('failed_jobs_id_seq'::regclass),
  "uuid" text COLLATE "pg_catalog"."default" NOT NULL,
  "connection" text COLLATE "pg_catalog"."default" NOT NULL,
  "queue" text COLLATE "pg_catalog"."default" NOT NULL,
  "payload" text COLLATE "pg_catalog"."default" NOT NULL,
  "exception" text COLLATE "pg_catalog"."default" NOT NULL,
  "failed_at" timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
)
;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for gps_registros
-- ----------------------------
DROP TABLE IF EXISTS "public"."gps_registros";
CREATE TABLE "public"."gps_registros" (
  "id_gps_registro" int4 NOT NULL DEFAULT nextval('gps_registros_id_gps_registro_seq'::regclass),
  "id_transporte" int4,
  "lat" numeric(8,6) NOT NULL,
  "lng" numeric(8,6) NOT NULL,
  "registro" timestamp(6),
  "estado" int4 DEFAULT 1,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of gps_registros
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS "public"."migrations";
CREATE TABLE "public"."migrations" (
  "id" int4 NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
  "migration" text COLLATE "pg_catalog"."default" NOT NULL,
  "batch" int4
)
;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS "public"."model_has_permissions";
CREATE TABLE "public"."model_has_permissions" (
  "permission_id" int4 NOT NULL DEFAULT nextval('model_has_permissions_permission_id_seq'::regclass),
  "model_type" text COLLATE "pg_catalog"."default" NOT NULL,
  "model_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS "public"."model_has_roles";
CREATE TABLE "public"."model_has_roles" (
  "role_id" int4 NOT NULL DEFAULT nextval('model_has_roles_role_id_seq'::regclass),
  "model_type" text COLLATE "pg_catalog"."default" NOT NULL,
  "model_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS "public"."password_resets";
CREATE TABLE "public"."password_resets" (
  "email" text COLLATE "pg_catalog"."default" NOT NULL,
  "token" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(6)
)
;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS "public"."permissions";
CREATE TABLE "public"."permissions" (
  "id" int4 NOT NULL DEFAULT nextval('permissions_id_seq'::regclass),
  "name" text COLLATE "pg_catalog"."default" NOT NULL,
  "guard_name" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS "public"."personal_access_tokens";
CREATE TABLE "public"."personal_access_tokens" (
  "id" int4 NOT NULL DEFAULT nextval('personal_access_tokens_id_seq'::regclass),
  "tokenable_type" text COLLATE "pg_catalog"."default" NOT NULL,
  "tokenable_id" int4 NOT NULL,
  "name" text COLLATE "pg_catalog"."default" NOT NULL,
  "token" text COLLATE "pg_catalog"."default" NOT NULL,
  "abilities" text COLLATE "pg_catalog"."default",
  "last_used_at" timestamp(6),
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO "public"."personal_access_tokens" VALUES (1, 'App\Models\User', 1, 'auth_token', '54ad31d954d0eff28eb958ff950b91e1a082e5349913086a320595bf6dda9a70', '["*"]', NULL, '2023-04-25 13:41:14', '2023-04-25 13:41:14');

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS "public"."personas";
CREATE TABLE "public"."personas" (
  "id_persona" int4 NOT NULL DEFAULT nextval('personas_id_persona_seq'::regclass),
  "nombres" text COLLATE "pg_catalog"."default" DEFAULT ''::text,
  "primer_apellido" text COLLATE "pg_catalog"."default" DEFAULT ''::text,
  "segundo_apellido" text COLLATE "pg_catalog"."default" DEFAULT ''::text,
  "ci" varchar(20) COLLATE "pg_catalog"."default" DEFAULT ''::character varying,
  "fecha_nacimiento" date,
  "genero" bool,
  "direccion" text COLLATE "pg_catalog"."default" DEFAULT ''::text,
  "celular" text COLLATE "pg_catalog"."default",
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of personas
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS "public"."role_has_permissions";
CREATE TABLE "public"."role_has_permissions" (
  "permission_id" int4 NOT NULL,
  "role_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS "public"."roles";
CREATE TABLE "public"."roles" (
  "id" int4 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
  "name" text COLLATE "pg_catalog"."default" NOT NULL,
  "guard_name" text COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO "public"."roles" VALUES (1, 'Administrator', 'admin', '2023-01-06 23:57:59', '2023-01-06 23:57:59');
INSERT INTO "public"."roles" VALUES (2, 'Chofers', 'chofer', '2023-01-06 23:57:59', '2023-01-06 23:57:59');
INSERT INTO "public"."roles" VALUES (3, 'Apoderados', 'apoderado', '2023-01-06 23:57:59', '2023-01-06 23:57:59');

-- ----------------------------
-- Table structure for transportes
-- ----------------------------
DROP TABLE IF EXISTS "public"."transportes";
CREATE TABLE "public"."transportes" (
  "id_transporte" int4 NOT NULL DEFAULT nextval('transportes_id_transporte_seq'::regclass),
  "id_chofer" int4 NOT NULL,
  "modelo" text COLLATE "pg_catalog"."default",
  "placa" text COLLATE "pg_catalog"."default",
  "cant_persona" int4 DEFAULT 0,
  "estado" int4 DEFAULT 1,
  "created_at" text COLLATE "pg_catalog"."default",
  "updated_at" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of transportes
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" int4 NOT NULL DEFAULT nextval('users_id_seq'::regclass),
  "id_persona" int4,
  "name" text COLLATE "pg_catalog"."default" NOT NULL,
  "email" text COLLATE "pg_catalog"."default" NOT NULL,
  "email_verified_at" timestamp(6),
  "password" text COLLATE "pg_catalog"."default" NOT NULL,
  "remember_token" text COLLATE "pg_catalog"."default",
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (1, NULL, 'user', 'user@user.com', NULL, '$2y$10$SDeAQCtDjPQcJiMHixWKKeVRy.mrprc3BTFUfxZXkMyAcFIJefhUG', NULL, '2023-04-25 13:41:14', '2023-04-25 13:41:14');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."apoderados_id_apoderado_seq"
OWNED BY "public"."apoderados"."id_apoderado";
SELECT setval('"public"."apoderados_id_apoderado_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."chofers_id_chofer_seq"
OWNED BY "public"."chofers"."id_chofer";
SELECT setval('"public"."chofers_id_chofer_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."estados_id_estado_seq"
OWNED BY "public"."estados"."id_estado";
SELECT setval('"public"."estados_id_estado_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."estudiante_asistencias_id_estudiante_asistencia_seq"
OWNED BY "public"."estudiante_asistencias"."id_estudiante_asistencia";
SELECT setval('"public"."estudiante_asistencias_id_estudiante_asistencia_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."estudiante_transportes_id_estudiante_transporte_seq"
OWNED BY "public"."estudiante_transportes"."id_estudiante_transporte";
SELECT setval('"public"."estudiante_transportes_id_estudiante_transporte_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."estudiantes_id_estudiante_seq"
OWNED BY "public"."estudiantes"."id_estudiante";
SELECT setval('"public"."estudiantes_id_estudiante_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."failed_jobs_id_seq"
OWNED BY "public"."failed_jobs"."id";
SELECT setval('"public"."failed_jobs_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."gps_registros_id_gps_registro_seq"
OWNED BY "public"."gps_registros"."id_gps_registro";
SELECT setval('"public"."gps_registros_id_gps_registro_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."migrations_id_seq"
OWNED BY "public"."migrations"."id";
SELECT setval('"public"."migrations_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."model_has_permissions_permission_id_seq"
OWNED BY "public"."model_has_permissions"."permission_id";
SELECT setval('"public"."model_has_permissions_permission_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."model_has_roles_role_id_seq"
OWNED BY "public"."model_has_roles"."role_id";
SELECT setval('"public"."model_has_roles_role_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."permissions_id_seq"
OWNED BY "public"."permissions"."id";
SELECT setval('"public"."permissions_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."personal_access_tokens_id_seq"
OWNED BY "public"."personal_access_tokens"."id";
SELECT setval('"public"."personal_access_tokens_id_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."personas_id_persona_seq"
OWNED BY "public"."personas"."id_persona";
SELECT setval('"public"."personas_id_persona_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."roles_id_seq"
OWNED BY "public"."roles"."id";
SELECT setval('"public"."roles_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."transportes_id_transporte_seq"
OWNED BY "public"."transportes"."id_transporte";
SELECT setval('"public"."transportes_id_transporte_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_id_seq"
OWNED BY "public"."users"."id";
SELECT setval('"public"."users_id_seq"', 2, true);

-- ----------------------------
-- Primary Key structure for table apoderados
-- ----------------------------
ALTER TABLE "public"."apoderados" ADD CONSTRAINT "apoderados_pkey" PRIMARY KEY ("id_apoderado");

-- ----------------------------
-- Primary Key structure for table chofers
-- ----------------------------
ALTER TABLE "public"."chofers" ADD CONSTRAINT "chofers_pkey" PRIMARY KEY ("id_chofer");

-- ----------------------------
-- Primary Key structure for table estados
-- ----------------------------
ALTER TABLE "public"."estados" ADD CONSTRAINT "estados_pkey" PRIMARY KEY ("id_estado");

-- ----------------------------
-- Primary Key structure for table estudiante_asistencias
-- ----------------------------
ALTER TABLE "public"."estudiante_asistencias" ADD CONSTRAINT "estudiante_asistencias_pkey" PRIMARY KEY ("id_estudiante_asistencia");

-- ----------------------------
-- Primary Key structure for table estudiante_transportes
-- ----------------------------
ALTER TABLE "public"."estudiante_transportes" ADD CONSTRAINT "estudiante_transportes_pkey" PRIMARY KEY ("id_estudiante_transporte");

-- ----------------------------
-- Primary Key structure for table estudiantes
-- ----------------------------
ALTER TABLE "public"."estudiantes" ADD CONSTRAINT "estudiantes_pkey" PRIMARY KEY ("id_estudiante");

-- ----------------------------
-- Primary Key structure for table failed_jobs
-- ----------------------------
ALTER TABLE "public"."failed_jobs" ADD CONSTRAINT "failed_jobs_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table gps_registros
-- ----------------------------
ALTER TABLE "public"."gps_registros" ADD CONSTRAINT "gps_registros_pkey" PRIMARY KEY ("id_gps_registro");

-- ----------------------------
-- Primary Key structure for table migrations
-- ----------------------------
ALTER TABLE "public"."migrations" ADD CONSTRAINT "migrations_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table model_has_permissions
-- ----------------------------
ALTER TABLE "public"."model_has_permissions" ADD CONSTRAINT "model_has_permissions_pkey" PRIMARY KEY ("permission_id");

-- ----------------------------
-- Primary Key structure for table model_has_roles
-- ----------------------------
ALTER TABLE "public"."model_has_roles" ADD CONSTRAINT "model_has_roles_pkey" PRIMARY KEY ("role_id");

-- ----------------------------
-- Primary Key structure for table password_resets
-- ----------------------------
ALTER TABLE "public"."password_resets" ADD CONSTRAINT "password_resets_pkey" PRIMARY KEY ("email");

-- ----------------------------
-- Primary Key structure for table permissions
-- ----------------------------
ALTER TABLE "public"."permissions" ADD CONSTRAINT "permissions_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table personal_access_tokens
-- ----------------------------
ALTER TABLE "public"."personal_access_tokens" ADD CONSTRAINT "personal_access_tokens_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table personas
-- ----------------------------
ALTER TABLE "public"."personas" ADD CONSTRAINT "personas_pkey" PRIMARY KEY ("id_persona");

-- ----------------------------
-- Primary Key structure for table role_has_permissions
-- ----------------------------
ALTER TABLE "public"."role_has_permissions" ADD CONSTRAINT "role_has_permissions_pkey" PRIMARY KEY ("permission_id", "role_id");

-- ----------------------------
-- Primary Key structure for table roles
-- ----------------------------
ALTER TABLE "public"."roles" ADD CONSTRAINT "roles_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table transportes
-- ----------------------------
ALTER TABLE "public"."transportes" ADD CONSTRAINT "transportes_pkey" PRIMARY KEY ("id_transporte");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table apoderados
-- ----------------------------
ALTER TABLE "public"."apoderados" ADD CONSTRAINT "apoderados_id_estudiante_fkey" FOREIGN KEY ("id_estudiante") REFERENCES "public"."estudiantes" ("id_estudiante") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."apoderados" ADD CONSTRAINT "apoderados_id_persona_fkey" FOREIGN KEY ("id_persona") REFERENCES "public"."personas" ("id_persona") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table chofers
-- ----------------------------
ALTER TABLE "public"."chofers" ADD CONSTRAINT "chofers_id_persona_fkey" FOREIGN KEY ("id_persona") REFERENCES "public"."personas" ("id_persona") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table estudiante_asistencias
-- ----------------------------
ALTER TABLE "public"."estudiante_asistencias" ADD CONSTRAINT "estudiante_asistencias_id_estado_fkey" FOREIGN KEY ("id_estado") REFERENCES "public"."estados" ("id_estado") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."estudiante_asistencias" ADD CONSTRAINT "estudiante_asistencias_id_estudiante_transporte_fkey" FOREIGN KEY ("id_estudiante_transporte") REFERENCES "public"."estudiante_transportes" ("id_estudiante_transporte") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table estudiante_transportes
-- ----------------------------
ALTER TABLE "public"."estudiante_transportes" ADD CONSTRAINT "estudiante_transportes_id_estado_fkey" FOREIGN KEY ("id_estado") REFERENCES "public"."estados" ("id_estado") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."estudiante_transportes" ADD CONSTRAINT "estudiante_transportes_id_estudiante_fkey" FOREIGN KEY ("id_estudiante") REFERENCES "public"."estudiantes" ("id_estudiante") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."estudiante_transportes" ADD CONSTRAINT "estudiante_transportes_id_transporte_fkey" FOREIGN KEY ("id_transporte") REFERENCES "public"."transportes" ("id_transporte") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table estudiantes
-- ----------------------------
ALTER TABLE "public"."estudiantes" ADD CONSTRAINT "estudiantes_id_persona_fkey" FOREIGN KEY ("id_persona") REFERENCES "public"."personas" ("id_persona") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table gps_registros
-- ----------------------------
ALTER TABLE "public"."gps_registros" ADD CONSTRAINT "gps_registros_id_transporte_fkey" FOREIGN KEY ("id_transporte") REFERENCES "public"."transportes" ("id_transporte") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table role_has_permissions
-- ----------------------------
ALTER TABLE "public"."role_has_permissions" ADD CONSTRAINT "role_has_permissions_permission_id_fkey" FOREIGN KEY ("permission_id") REFERENCES "public"."permissions" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."role_has_permissions" ADD CONSTRAINT "role_has_permissions_role_id_fkey" FOREIGN KEY ("role_id") REFERENCES "public"."roles" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table transportes
-- ----------------------------
ALTER TABLE "public"."transportes" ADD CONSTRAINT "transportes_id_chofer_fkey" FOREIGN KEY ("id_chofer") REFERENCES "public"."chofers" ("id_chofer") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_id_persona_fkey" FOREIGN KEY ("id_persona") REFERENCES "public"."personas" ("id_persona") ON DELETE NO ACTION ON UPDATE NO ACTION;

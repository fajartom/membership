/*
 Navicat Premium Data Transfer

 Source Server         : DATABASE LOCAL
 Source Server Type    : PostgreSQL
 Source Server Version : 90610
 Source Host           : localhost:5432
 Source Catalog        : LOGBOOK
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 90610
 File Encoding         : 65001

 Date: 29/05/2019 02:20:08
*/


-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS "public"."provinces";
CREATE TABLE "public"."provinces" (
  "id_province" int4 NOT NULL DEFAULT nextval('districts_id_seq'::regclass),
  "name" varchar COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO "public"."provinces" VALUES (11, 'ACEH');
INSERT INTO "public"."provinces" VALUES (12, 'SUMATERA UTARA');
INSERT INTO "public"."provinces" VALUES (13, 'SUMATERA BARAT');
INSERT INTO "public"."provinces" VALUES (14, 'RIAU');
INSERT INTO "public"."provinces" VALUES (15, 'JAMBI');
INSERT INTO "public"."provinces" VALUES (16, 'SUMATERA SELATAN');
INSERT INTO "public"."provinces" VALUES (17, 'BENGKULU');
INSERT INTO "public"."provinces" VALUES (18, 'LAMPUNG');
INSERT INTO "public"."provinces" VALUES (19, 'KEPULAUAN BANGKA BELITUNG');
INSERT INTO "public"."provinces" VALUES (21, 'KEPULAUAN RIAU');
INSERT INTO "public"."provinces" VALUES (31, 'DKI JAKARTA');
INSERT INTO "public"."provinces" VALUES (32, 'JAWA BARAT');
INSERT INTO "public"."provinces" VALUES (33, 'JAWA TENGAH');
INSERT INTO "public"."provinces" VALUES (34, 'DI YOGYAKARTA');
INSERT INTO "public"."provinces" VALUES (35, 'JAWA TIMUR');
INSERT INTO "public"."provinces" VALUES (36, 'BANTEN');
INSERT INTO "public"."provinces" VALUES (51, 'BALI');
INSERT INTO "public"."provinces" VALUES (52, 'NUSA TENGGARA BARAT');
INSERT INTO "public"."provinces" VALUES (53, 'NUSA TENGGARA TIMUR');
INSERT INTO "public"."provinces" VALUES (61, 'KALIMANTAN BARAT');
INSERT INTO "public"."provinces" VALUES (62, 'KALIMANTAN TENGAH');
INSERT INTO "public"."provinces" VALUES (63, 'KALIMANTAN SELATAN');
INSERT INTO "public"."provinces" VALUES (64, 'KALIMANTAN TIMUR');
INSERT INTO "public"."provinces" VALUES (65, 'KALIMANTAN UTARA');
INSERT INTO "public"."provinces" VALUES (71, 'SULAWESI UTARA');
INSERT INTO "public"."provinces" VALUES (72, 'SULAWESI TENGAH');
INSERT INTO "public"."provinces" VALUES (73, 'SULAWESI SELATAN');
INSERT INTO "public"."provinces" VALUES (74, 'SULAWESI TENGGARA');
INSERT INTO "public"."provinces" VALUES (75, 'GORONTALO');
INSERT INTO "public"."provinces" VALUES (76, 'SULAWESI BARAT');
INSERT INTO "public"."provinces" VALUES (81, 'MALUKU');
INSERT INTO "public"."provinces" VALUES (82, 'MALUKU UTARA');
INSERT INTO "public"."provinces" VALUES (91, 'PAPUA BARAT');
INSERT INTO "public"."provinces" VALUES (94, 'PAPUA');

-- ----------------------------
-- Primary Key structure for table provinces
-- ----------------------------
ALTER TABLE "public"."provinces" ADD CONSTRAINT "districts_pkey" PRIMARY KEY ("id_province");

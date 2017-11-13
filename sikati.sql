/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     12/11/2017 22:27:36                          */
/*==============================================================*/


drop table if exists LIST_ADMIN;

drop table if exists LIST_DATA_KEGIATAN;

drop table if exists LIST_JUDUL_KEGIATAN;

drop table if exists LIST_KAS_RUTIN;

drop table if exists LIST_PENGURUS;

drop table if exists MASTER;

/*==============================================================*/
/* Table: LIST_ADMIN                                            */
/*==============================================================*/
create table LIST_ADMIN
(
   ID_ADMIN             varchar(2) not null,
   LEVEL                varchar(10),
   PASSWORD             varchar(10),
   primary key (ID_ADMIN)
);

/*==============================================================*/
/* Table: LIST_DATA_KEGIATAN                                    */
/*==============================================================*/
create table LIST_DATA_KEGIATAN
(
   ID_DATA              varchar(4) not null,
   ID_JUDUL             varchar(3),
   ID_MASTER            varchar(4),
   URAIAN               varchar(30),
   DEBIT_KGT            varchar(8),
   KREDIT_KGT           varchar(8),
   JUMLAH               varchar(8),
   TANGGAL              date,
   KETERANGAN           varchar(50),
   primary key (ID_DATA)
);

/*==============================================================*/
/* Table: LIST_JUDUL_KEGIATAN                                   */
/*==============================================================*/
create table LIST_JUDUL_KEGIATAN
(
   ID_JUDUL             varchar(3) not null,
   JUDUL_KEGIATAN       varchar(50),
   primary key (ID_JUDUL)
);

/*==============================================================*/
/* Table: LIST_KAS_RUTIN                                        */
/*==============================================================*/
create table LIST_KAS_RUTIN
(
   ID_KAS               varchar(4) not null,
   ID_PENGURUS          varchar(3),
   ID_MASTER            varchar(4),
   TGL                  date,
   JUMLAH               varchar(8),
   primary key (ID_KAS)
);

/*==============================================================*/
/* Table: LIST_PENGURUS                                         */
/*==============================================================*/
create table LIST_PENGURUS
(
   ID_PENGURUS          varchar(3) not null,
   NAMA_PENGURUS        varchar(30),
   primary key (ID_PENGURUS)
);

/*==============================================================*/
/* Table: MASTER                                                */
/*==============================================================*/
create table MASTER
(
   ID_MASTER            varchar(4) not null,
   TGL                  date,
   DEBET_MS             varchar(8),
   KREDIT_MS            varchar(8),
   KET_MS               varchar(50),
   SALDO_MS             varchar(8),
   primary key (ID_MASTER)
);

alter table LIST_DATA_KEGIATAN add constraint FK_DEBET_DAN_KREDIT foreign key (ID_MASTER)
      references MASTER (ID_MASTER) on delete restrict on update restrict;

alter table LIST_DATA_KEGIATAN add constraint FK_MEMILIKI foreign key (ID_JUDUL)
      references LIST_JUDUL_KEGIATAN (ID_JUDUL) on delete restrict on update restrict;

alter table LIST_KAS_RUTIN add constraint FK_DEBET foreign key (ID_MASTER)
      references MASTER (ID_MASTER) on delete restrict on update restrict;

alter table LIST_KAS_RUTIN add constraint FK_MEMBAYAR foreign key (ID_PENGURUS)
      references LIST_PENGURUS (ID_PENGURUS) on delete restrict on update restrict;

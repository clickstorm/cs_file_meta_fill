CREATE TABLE cs_file_meta_fill (
   original_filename varchar(255) DEFAULT '' NOT NULL,
   final_filename varchar(255) DEFAULT '' NOT NULL,
   PRIMARY KEY (original_filename,final_filename)
);
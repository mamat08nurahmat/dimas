TYPE=VIEW
query=select `a`.`id` AS `id`,`a`.`no_pemesan` AS `no_pemesan`,`b`.`nama` AS `nama`,`b`.`kelompok` AS `kelompok`,`c`.`kode_grab` AS `kode_grab`,`c`.`used_at` AS `used_at` from ((`chatbotwa`.`form_order_grab` `a` left join `chatbotwa`.`form_users` `b` on((`a`.`no_pemesan` = `b`.`kontak`))) left join `chatbotwa`.`form_kode_grab` `c` on((`a`.`id_kode_grab` = `c`.`id`))) order by `c`.`used_at` desc
md5=ecec8e3aca7b91613028e995c822a983
updatable=0
algorithm=0
definer_user=root
definer_host=%
suid=1
with_check_option=0
timestamp=2019-09-01 00:26:45
create-version=1
source=select `a`.`id` AS `id`,`a`.`no_pemesan` AS `no_pemesan`,`b`.`nama` AS `nama`,`b`.`kelompok` AS `kelompok`,`c`.`kode_grab` AS `kode_grab`,`c`.`used_at` AS `used_at` from ((`form_order_grab` `a` left join `form_users` `b` on((`a`.`no_pemesan` = `b`.`kontak`))) left join `form_kode_grab` `c` on((`a`.`id_kode_grab` = `c`.`id`))) order by `c`.`used_at` desc
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `a`.`id` AS `id`,`a`.`no_pemesan` AS `no_pemesan`,`b`.`nama` AS `nama`,`b`.`kelompok` AS `kelompok`,`c`.`kode_grab` AS `kode_grab`,`c`.`used_at` AS `used_at` from ((`chatbotwa`.`form_order_grab` `a` left join `chatbotwa`.`form_users` `b` on((`a`.`no_pemesan` = `b`.`kontak`))) left join `chatbotwa`.`form_kode_grab` `c` on((`a`.`id_kode_grab` = `c`.`id`))) order by `c`.`used_at` desc

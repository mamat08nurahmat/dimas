TYPE=VIEW
query=select `g`.`id` AS `id`,`g`.`no_pemesan` AS `no_pemesan`,`u`.`nama` AS `nama`,`k`.`kode_grab` AS `kode_grab`,`g`.`timestamp` AS `timestamp` from ((`chatbotwa`.`form_order_grab` `g` left join `chatbotwa`.`form_kode_grab` `k` on((`g`.`id_kode_grab` = `k`.`id`))) left join `chatbotwa`.`form_users` `u` on((`g`.`no_pemesan` = `u`.`kontak`)))
md5=e48b2c6c7494b480feab4c89fcf28ae6
updatable=0
algorithm=0
definer_user=root
definer_host=%
suid=1
with_check_option=0
timestamp=2019-09-01 00:26:45
create-version=1
source=select `g`.`id` AS `id`,`g`.`no_pemesan` AS `no_pemesan`,`u`.`nama` AS `nama`,`k`.`kode_grab` AS `kode_grab`,`g`.`timestamp` AS `timestamp` from ((`form_order_grab` `g` left join `form_kode_grab` `k` on((`g`.`id_kode_grab` = `k`.`id`))) left join `form_users` `u` on((`g`.`no_pemesan` = `u`.`kontak`)))
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `g`.`id` AS `id`,`g`.`no_pemesan` AS `no_pemesan`,`u`.`nama` AS `nama`,`k`.`kode_grab` AS `kode_grab`,`g`.`timestamp` AS `timestamp` from ((`chatbotwa`.`form_order_grab` `g` left join `chatbotwa`.`form_kode_grab` `k` on((`g`.`id_kode_grab` = `k`.`id`))) left join `chatbotwa`.`form_users` `u` on((`g`.`no_pemesan` = `u`.`kontak`)))

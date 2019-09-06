<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_cicool extends CI_Migration {

        public function up()
        {
                //create table groups
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => TRUE,
                        ),
                        'definition' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('aauth_groups');

                //create table group to group
                $this->dbforge->add_field(array(
                        'group_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                        ),
                        'subgroup_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                        )
                ));
                $this->dbforge->add_key('group_id', TRUE);
                $this->dbforge->add_key('subgroup_id', TRUE);
                $this->dbforge->create_table('aauth_group_to_group');


                //create table group to group
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'ip_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 39,
                                'null' => TRUE,
                        ),
                        'timestamp' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'login_attempts' => array(
                                'type' => 'TINYINT',
                                'constraint' => 2,
                                'null' => TRUE,
                                'unsigned' => TRUE,
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('aauth_login_attempts');

                 //create table perms
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                                'unsigned' => TRUE,
                                'null' => TRUE
                        ),
                        'definition' => array(
                                'type' => 'TEXT',
                                'null' => TRUE
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('aauth_perms');


                //create table perm_to_group
                $this->dbforge->add_field(array(
                        'perm_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                        ),
                        'group_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                        )
                ));
                $this->dbforge->create_table('aauth_perm_to_group');

                //create table cc_session
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                        ),
                        'ip_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 45,
                        ),
                        'timestamp' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                        ),
                        'data' => array(
                                'type' => 'BLOB',
                        )
                ));
                $this->dbforge->create_table('cc_session');
                $this->dbforge->add_key('id', TRUE);

                //create table perm_to_user
                $this->dbforge->add_field(array(
                        'perm_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                        ),
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                        )
                ));
                $this->dbforge->add_key('user_id', TRUE);
                $this->dbforge->add_key('perm_id', TRUE);
                $this->dbforge->create_table('aauth_perm_to_user');


                //create table pms
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'index' => TRUE,
                                'auto_increment' => TRUE,
                                'unsigned' => TRUE,
                        ),
                        'sender_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'index' => TRUE,
                                'unsigned' => TRUE,
                        ),
                        'receiver_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'index' => TRUE,
                                'unsigned' => TRUE,
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 225,
                        ),
                        'message' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'date_sent' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'date_read' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                                'index' => TRUE
                        ),
                        'pm_deleted_sender' => array(
                                'type' => 'INT',
                                'constraint' => 1,
                                'null' => TRUE,
                        ),
                        'pm_deleted_receiver' => array(
                                'type' => 'INT',
                                'constraint' => 1,
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('aauth_pms');


                //create table user
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                                'null' => TRUE
                        ),
                        'definition' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('aauth_user');


                 //create table users
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
                        'oauth_uid' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'oauth_provider' => array(
                                'type' => 'VARCHAR',
                                'null' => TRUE,
                                'constraint' => 100,
                        ),
                        'pass' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 64,
                        ),
                        'username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
                        'full_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'avatar' => array(
                                'type' => 'TEXT',
                        ),
                        'banned' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                                'null' => TRUE,
                                'default' => 0
                        ),
                        'last_login' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'last_activity' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'date_created' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'forgot_exp' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'remember_time' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'remember_exp' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'verification_code' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'top_secret' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 16,
                                'null' => TRUE,
                        ),
                        'ip_address' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('aauth_users');


                //create table user_to_group
                $this->dbforge->add_field(array(
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                        ),  
                        'group_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('user_id', TRUE);
                $this->dbforge->add_key('group_id', TRUE);
                $this->dbforge->create_table('aauth_user_to_group');



                //create table user_to_group
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),  
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'index' => TRUE
                        ),
                        'data_key' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
                        'value' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('aauth_user_variables');

                //create table blog
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),  
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'slug' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'content' => array(
                                'type' => 'TEXT',
                        ), 
                        'image' => array(
                                'type' => 'TEXT',
                        ),
                        'tags' => array(
                                'type' => 'TEXT',
                        ),
                        'category' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'status' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 10,
                        ),
                        'author' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
                        'viewers' => array(
                                'type' => 'INT',
                        ),
                        'created_at' => array(
                                'type' => 'DATETIME',
                        ),
                        'updated_at' => array(
                                'type' => 'DATETIME',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('blog');

                 //create table blog
                $this->dbforge->add_field(array(
                        'category_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),  
                        'category_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'category_desc' => array(
                                'type' => 'TEXT',
                        )
                ));
                $this->dbforge->add_key('category_id', TRUE);
                $this->dbforge->create_table('blog_category');

                //create table menu
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'label' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => TRUE,
                        ),
                        'type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => TRUE,
                        ),
                        'icon_color' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => TRUE,
                        ),
                        'link' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => TRUE,
                        ),
                        'sort' => array(
                                'type' => 'INT',
                        ),
                        'parent' => array(
                                'type' => 'INT',
                        ),
                        'icon' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '50',
                                'null' => TRUE,
                        ),
                        'menu_type_id' => array(
                                'type' => 'INT',
                        ),
                        'active' => array(
                                'type' => 'INT',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('menu');

                //create table menu type
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'definition' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('menu_type');


                //insert dummy data
                $this->db->insert_batch('aauth_groups', [
                    [
                        'name' => 'Admin',
                        'definition' => 'Superadmin Group'
                    ],   
                    [
                        'name' => 'Public',
                        'definition' => 'Public Group'
                    ], 
                    [
                        'name' => 'Default',
                        'definition' => 'Default Access Group'
                    ],
                    [
                        'name' => 'Member',
                        'definition' => 'Member Access Group'
                    ],
                ]);

                //create table crud
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'subject' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'table_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'primary_key' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'page_read' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                                'null' => TRUE,
                        ),
                        'page_create' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                                'null' => TRUE,
                        ),
                        'page_update' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('crud');

                //create table form
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'subject' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'table_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('form');


                //create table rest
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'subject' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'table_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'primary_key' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'x_api_key' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                                'null' => TRUE,
                        ),
                        'x_token' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                                'null' => TRUE,
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('rest');


                $this->db->insert_batch('aauth_user_to_group', [
                    [
                        'user_id' => 1,
                        'group_id' => 1
                    ]
                ]);


                //create table crud input type
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'relation' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                        ),
                        'custom_value' => array(
                                'type' => 'INT',
                        ),
                        'validation_group' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('crud_input_type');

                //create table rest input type
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'relation' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                        ),
                        'validation_group' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('rest_input_type');

                //create table crud field validation
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'crud_field_id' => array(
                                'type' => 'INT',
                        ),
                        'crud_id' => array(
                                'type' => 'INT',
                        ),
                        'validation_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'validation_value' => array(
                                'type' => 'TEXT',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('crud_field_validation');


                //create table rest field validation
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'rest_field_id' => array(
                                'type' => 'INT',
                        ),
                        'rest_id' => array(
                                'type' => 'INT',
                        ),
                        'validation_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'validation_value' => array(
                                'type' => 'TEXT',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('rest_field_validation');


                //create table crud input type
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'crud_id' => array(
                                'type' => 'INT',
                        ),
                        'field_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'field_label' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        ),
                        'input_type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'show_column' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'show_add_form' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'show_update_form' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'show_detail_page' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'sort' => array(
                                'type' => 'INT',
                        ),
                        'relation_table' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        ),
                        'relation_value' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        ),
                        'relation_label' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('crud_field');

                //create table rest field
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'rest_id' => array(
                                'type' => 'INT',
                        ),
                        'field_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'field_label' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        ),
                        'input_type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'show_column' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'show_add_api' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'show_update_api' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'show_detail_api' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('rest_field');


                $this->db->insert_batch('crud_input_type', [
                    [
                        'type'      => 'input',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'input'
                    ],
                    [
                        'type'      => 'textarea',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'text'
                    ],
                    [
                        'type'      => 'select',
                        'relation'  => 1,
                        'custom_value' => 0,
                        'validation_group' => 'select'
                    ],
                    [
                        'type'      => 'editor_wysiwyg',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'editor'
                    ],
                    [
                        'type'      => 'password',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'password'
                    ],
                    [
                        'type'      => 'email',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'email'
                    ],
                    [
                        'type'      => 'address_map',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'address_map'
                    ],
                    [
                        'type'      => 'file',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'file'
                    ],
                    [
                        'type'      => 'file_multiple',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'file_multiple'
                    ],
                    [
                        'type'      => 'datetime',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'datetime'
                    ],
                    [
                        'type'      => 'date',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'date'
                    ],
                    [
                        'type'      => 'timestamp',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'timestamp'
                    ],
                    [
                        'type'      => 'number',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'number'
                    ],
                    [
                        'type'      => 'yes_no',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'yes_no'
                    ],
                    [
                        'type'      => 'time',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'time'
                    ],
                    [
                        'type'      => 'year',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'year'
                    ],
                    [
                        'type'      => 'select_multiple',
                        'relation'  => 1,
                        'custom_value' => 0,
                        'validation_group' => 'select_multiple'
                    ],
                    [
                        'type'      => 'checkboxes',
                        'relation'  => 1,
                        'custom_value' => 0,
                        'validation_group' => 'checkboxes'
                    ],
                    [
                        'type'      => 'options',
                        'relation'  => 1,
                        'custom_value' => 0,
                        'validation_group' => 'options'
                    ],
                    [
                        'type'      => 'true_false',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'true_false'
                    ],
                    [
                        'type'      => 'current_user_username',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'user_username'
                    ],
                    [
                        'type'      => 'current_user_id',
                        'relation'  => 0,
                        'custom_value' => 0,
                        'validation_group' => 'current_user_id'
                    ],
                    [
                        'type'      => 'custom_option',
                        'relation'  => 0,
                        'custom_value' => 1,
                        'validation_group' => 'custom_option'
                    ],
                    [
                        'type'      => 'custom_checkbox',
                        'relation'  => 0,
                        'custom_value' => 1,
                        'validation_group' => 'custom_checkbox'
                    ],
                    [
                        'type'      => 'custom_select_multiple',
                        'relation'  => 0,
                        'custom_value' => 1,
                        'validation_group' => 'custom_select_multiple'
                    ],
                    [
                        'type'      => 'custom_select',
                        'relation'  => 0,
                        'custom_value' => 1,
                        'validation_group' => 'custom_select'
                    ],
                ]);


                $this->db->insert_batch('rest_input_type', [
                    [
                        'type'      => 'input',
                        'relation'  => 0,
                        'validation_group' => 'input'
                    ], 
                    [
                        'type'      => 'timestamp',
                        'relation'  => 0,
                        'validation_group' => 'timestamp'
                    ],
                    [
                        'type'      => 'file',
                        'relation'  => 0,
                        'validation_group' => 'file'
                    ]
                ]);

                 //create table captcha
                $this->dbforge->add_field(array(
                        'captcha_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'captcha_time' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'ip_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                        'word' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                        ),
                ));
                $this->dbforge->add_key('captcha_id', TRUE);
                $this->dbforge->create_table('captcha');

                 //create table form field
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'form_id' => array(
                                'type' => 'INT',
                        ),
                        'sort' => array(
                                'type' => 'INT',
                        ),
                        'field_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'input_type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'field_label' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        ),
                        'placeholder' => array(
                                'type' => 'TEXT',
                                'null' => true
                        ),
                        'auto_generate_help_block' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                                'null' => true
                        ),
                        'help_block' => array(
                                'type' => 'TEXT',
                                'null' => true
                        ),
                        'relation_table' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        ),
                        'relation_value' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        ),
                        'relation_label' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => true
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('form_field');


                //create table page
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'content' => array(
                                'type' => 'TEXT',
                        ),
                        'fresh_content' => array(
                                'type' => 'TEXT',
                        ),
                        'keyword' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'link' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => TRUE,
                        ),
                        'template' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                                'null' => TRUE,
                        ),
                        'created_at' => array(
                                'type' => 'TIMESTAMP',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('page');

                //create table form field validation
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'form_field_id' => array(
                                'type' => 'INT',
                        ),
                        'form_id' => array(
                                'type' => 'INT',
                        ),
                        'validation_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'validation_value' => array(
                                'type' => 'TEXT',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('form_field_validation');


                //create table cc options
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'option_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'option_value' => array(
                                'type' => 'TEXT',
                                'null' => true
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('cc_options');  

                //add option 
                add_option('active_theme', 'cicool');
                add_option('favicon', 'default.png');

                //create table page block element
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'group_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200
                        ),
                        'content' => array(
                                'type' => 'TEXT',
                        ),
                        'image_preview' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'block_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'content_type' => array(
                                 'type' => 'VARCHAR',
                                'constraint' => '100',
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('page_block_element');

                //create table crud custom attribute
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'form_field_id' => array(
                                'type' => 'INT',
                        ),
                        'form_id' => array(
                                'type' => 'INT',
                        ),
                        'attribute_value' => array(
                                'type' => 'TEXT',
                        ),
                        'attribute_label' => array(
                                'type' => 'TEXT',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('form_custom_attribute');

                //create table form custom value
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'form_field_id' => array(
                                'type' => 'INT',
                        ),
                        'form_id' => array(
                                'type' => 'INT',
                        ),
                        'option_value' => array(
                                'type' => 'TEXT',
                        ),
                        'option_label' => array(
                                'type' => 'TEXT',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('form_custom_option');



                //create table crud input validation
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'validation' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'input_able' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '20',
                        ),
                        'group_input' => array(
                                'type' => 'TEXT',
                        ),
                        'input_placeholder' => array(
                                'type' => 'TEXT',
                        ),
                        'call_back' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '10',
                        ),
                        'input_validation' => array(
                                'type' => 'TEXT',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('crud_input_validation');


                $this->db->insert_batch('crud_input_validation', [
                     [ 
                        'validation' => 'required', 
                        'input_able' => 'no', 
                        'group_input' => 'input, file, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes, true_false, address_map, custom_option, custom_checkbox, custom_select_multiple, custom_select, file_multiple',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'max_length', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, number, text, select, password, email, editor, yes_no, time, year, select_multiple, options, checkboxes, address_map',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'min_length', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, number, text, select, password, email, editor, time, year, select_multiple, address_map',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => 'numeric'

                     ],
                     [ 
                        'validation' => 'valid_email', 
                        'input_able' => 'no', 
                        'group_input' => 'input, email',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'valid_emails', 
                        'input_able' => 'no', 
                        'group_input' => 'input, email',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'regex', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => 'callback_valid_regex'

                     ],
                     [ 
                        'validation' => 'decimal', 
                        'input_able' => 'no', 
                        'group_input' => 'input, number, text, select',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'allowed_extension', 
                        'input_able' => 'yes', 
                        'group_input' => 'file, file_multiple',
                        'input_placeholder' => 'ex : jpg,png,..',
                        'call_back' => '',
                        'input_validation' => 'callback_valid_extension_list'

                     ],
                     [ 
                        'validation' => 'max_width', 
                        'input_able' => 'yes', 
                        'group_input' => 'file, file_multiple',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => 'numeric'

                     ],
                     [ 
                        'validation' => 'max_height', 
                        'input_able' => 'yes', 
                        'group_input' => 'file, file_multiple',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => 'numeric'

                     ],
                     [ 
                        'validation' => 'max_size', 
                        'input_able' => 'yes', 
                        'group_input' => 'file, file_multiple',
                        'input_placeholder' => '... kb',
                        'call_back' => '',
                        'input_validation' => 'numeric'

                     ],
                     [ 
                        'validation' => 'max_item', 
                        'input_able' => 'yes', 
                        'group_input' => 'file_multiple',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => 'numeric'

                     ],
                     [ 
                        'validation' => 'valid_url', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'alpha', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text, select, password, editor, yes_no',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'alpha_numeric', 
                        'input_able' => 'no', 
                        'group_input' => 'input, number, text, select, password, editor',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'alpha_numeric_spaces', 
                        'input_able' => 'no', 
                        'group_input' => 'input, number, text,select, password, editor',
                        'input_placeholder' => '',
                        'call_back' => '',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'valid_number', 
                        'input_able' => 'no', 
                        'group_input' => 'input, number, text, password, editor, true_false',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'valid_datetime', 
                        'input_able' => 'no', 
                        'group_input' => 'input, datetime, text',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'valid_date', 
                        'input_able' => 'no', 
                        'group_input' => 'input, datetime, date, text',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => ''

                     ],
                     [ 
                        'validation' => 'valid_max_selected_option', 
                        'input_able' => 'yes', 
                        'group_input' => 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'valid_min_selected_option', 
                        'input_able' => 'yes', 
                        'group_input' => 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'valid_alpha_numeric_spaces_underscores', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text,select, password, editor',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => ''
                     ],
                     [ 
                        'validation' => 'matches', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, number, text, password, email',
                        'input_placeholder' => 'any field',
                        'call_back' => 'no',
                        'input_validation' => 'callback_valid_alpha_numeric_spaces_underscores'
                     ],
                     [ 
                        'validation' => 'valid_json', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text, editor',
                        'input_placeholder' => '',
                        'call_back' => 'yes',
                        'input_validation' => ' '
                     ],
                     [ 
                        'validation' => 'valid_url', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text, editor',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => ' '
                     ],
                     [ 
                        'validation' => 'exact_length', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '0 - 99999*',
                        'call_back' => 'no',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'alpha_dash', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => ''
                     ],
                     [ 
                        'validation' => 'integer', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => ''
                     ],
                     [ 
                        'validation' => 'differs', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, text, number, email, password, editor, options, select',
                        'input_placeholder' => 'any field',
                        'call_back' => 'no',
                        'input_validation' => 'callback_valid_alpha_numeric_spaces_underscores'
                     ],
                     [ 
                        'validation' => 'is_natural', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => ''
                     ],
                     [ 
                        'validation' => 'is_natural_no_zero', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => ''
                     ],
                     [ 
                        'validation' => 'less_than', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'less_than_equal_to', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'greater_than', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'greater_than_equal_to', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, text, number',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => 'numeric'
                     ],
                     [ 
                        'validation' => 'in_list', 
                        'input_able' => 'yes', 
                        'group_input' => 'input, text, number, select, options',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => 'callback_valid_multiple_value'
                     ],
                     [ 
                        'validation' => 'valid_ip', 
                        'input_able' => 'no', 
                        'group_input' => 'input, text',
                        'input_placeholder' => '',
                        'call_back' => 'no',
                        'input_validation' => ''
                     ],

                ]);


                //create table crud custom value
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'crud_field_id' => array(
                                'type' => 'INT',
                        ),
                        'crud_id' => array(
                                'type' => 'INT',
                        ),
                        'option_value' => array(
                                'type' => 'TEXT',
                        ),
                        'option_label' => array(
                                'type' => 'TEXT',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('crud_custom_option');


                //insert dummy data
                $this->db->insert_batch('aauth_perms', [
                    [ 'name' => 'menu_dashboard' ],
                    [ 'name' => 'menu_crud_builder' ],
                    [ 'name' => 'menu_api_builder' ],
                    [ 'name' => 'menu_page_builder' ],
                    [ 'name' => 'menu_form_builder' ],
                    [ 'name' => 'menu_menu' ],
                    [ 'name' => 'menu_auth' ],
                    [ 'name' => 'menu_user' ],
                    [ 'name' => 'menu_group' ],
                    [ 'name' => 'menu_access' ],
                    [ 'name' => 'menu_permission' ],
                    [ 'name' => 'menu_api_documentation' ],
                    [ 'name' => 'menu_web_documentation' ],
                    [ 'name' => 'menu_settings' ],

                    [ 'name' => 'user_list' ],
                    [ 'name' => 'user_update_status' ],
                    [ 'name' => 'user_export' ],
                    [ 'name' => 'user_add' ],
                    [ 'name' => 'user_update' ],
                    [ 'name' => 'user_update_profile' ],
                    [ 'name' => 'user_update_password' ],
                    [ 'name' => 'user_profile' ],
                    [ 'name' => 'user_view' ],
                    [ 'name' => 'user_delete' ],

                    [ 'name' => 'blog_list' ],
                    [ 'name' => 'blog_export' ],
                    [ 'name' => 'blog_add' ],
                    [ 'name' => 'blog_update' ],
                    [ 'name' => 'blog_view' ],
                    [ 'name' => 'blog_delete' ],

                    [ 'name' => 'form_list' ],
                    [ 'name' => 'form_export' ],
                    [ 'name' => 'form_add' ],
                    [ 'name' => 'form_update' ],
                    [ 'name' => 'form_view' ],
                    [ 'name' => 'form_manage' ],
                    [ 'name' => 'form_delete' ],

                    [ 'name' => 'crud_list' ],
                    [ 'name' => 'crud_export' ],
                    [ 'name' => 'crud_add' ],
                    [ 'name' => 'crud_update' ],
                    [ 'name' => 'crud_view' ],
                    [ 'name' => 'crud_delete' ],

                    [ 'name' => 'rest_list' ],
                    [ 'name' => 'rest_export' ],
                    [ 'name' => 'rest_add' ],
                    [ 'name' => 'rest_update' ],
                    [ 'name' => 'rest_view' ],
                    [ 'name' => 'rest_delete' ],

                    [ 'name' => 'group_list' ],
                    [ 'name' => 'group_export' ],
                    [ 'name' => 'group_add' ],
                    [ 'name' => 'group_update' ],
                    [ 'name' => 'group_view' ],
                    [ 'name' => 'group_delete' ],

                    [ 'name' => 'permission_list' ],
                    [ 'name' => 'permission_export' ],
                    [ 'name' => 'permission_add' ],
                    [ 'name' => 'permission_update' ],
                    [ 'name' => 'permission_view' ],
                    [ 'name' => 'permission_delete' ],

                    [ 'name' => 'access_list' ],
                    [ 'name' => 'access_add' ],
                    [ 'name' => 'access_update' ],
                    [ 'name' => 'menu_list' ],

                    [ 'name' => 'menu_add' ],
                    [ 'name' => 'menu_update' ],
                    [ 'name' => 'menu_delete' ],
                    [ 'name' => 'menu_save_ordering' ],
                    [ 'name' => 'menu_type_add' ],

                    [ 'name' => 'page_list' ],
                    [ 'name' => 'page_export' ],
                    [ 'name' => 'page_add' ],
                    [ 'name' => 'page_update' ],
                    [ 'name' => 'page_view' ],
                    [ 'name' => 'page_delete' ],

                    [ 'name' => 'blog_list' ],
                    [ 'name' => 'blog_export' ],
                    [ 'name' => 'blog_add' ],
                    [ 'name' => 'blog_update' ],
                    [ 'name' => 'blog_view' ],
                    [ 'name' => 'blog_delete' ],

                    [ 'name' => 'setting' ],
                    [ 'name' => 'setting_update' ],

                    [ 'name' => 'dashboard' ],

                    [ 'name' => 'extension_list' ],
                    [ 'name' => 'extension_activate' ],
                    [ 'name' => 'extension_deactivate' ],
                ]); 

                //insert dummy data
                $this->db->insert_batch('blog_category', [
                    [ 'category_name'           => 'Technology' ],
                    [ 'category_name'           => 'Lifestyle' ],
                ]);   

                $this->db->insert_batch('blog', [
                    [ 
                        'title'           => 'Hello Wellcome To Cicool Builder' ,
                        'slug'           => url_title('Hello Wellcome To Ciool Builder') ,
                        'category' => 1 ,
                        'tags' => 'greetings' ,
                        'author' => 'admin' ,
                        'status' => 'publish' ,
                        'image' => 'wellcome.jpg' ,
                        'content' => 'greetings from our team I hope to be happy! ' ,
                        'created_at' => date('Y-m-d H:i:s') ,
                    ],
                ]);   




                //insert dummy data
                $this->db->insert_batch('menu_type', [
                    [ 'name' => 'side menu' ],
                    [ 'name' => 'top menu' ],
                ]);


                //insert dummy data menu admin
                $this->db->insert_batch('menu', [
                    [ 
                        'label'         => 'MAIN NAVIGATION', 
                        'link'          => 'administrator/dashboard', 
                        'sort'          => 1, 
                        'parent'        => '',   
                        'icon'          => '',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'label',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Dashboard', 
                        'link'          => 'administrator/dashboard', 
                        'sort'          => 2, 
                        'parent'        => '',   
                        'icon'          => 'fa-dashboard',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'CRUD Builder', 
                        'link'          => 'administrator/crud', 
                        'sort'          => 3, 
                        'parent'        => '',   
                        'icon'          => 'fa-table',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'API Builder', 
                        'link'          => 'administrator/rest', 
                        'sort'          => 4, 
                        'parent'        => '',   
                        'icon'          => 'fa-code',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Page Builder', 
                        'link'          => 'administrator/page', 
                        'sort'          => 5, 
                        'parent'        => '',   
                        'icon'          => 'fa-file-o',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Form Builder', 
                        'link'          => 'administrator/form', 
                        'sort'          => 6, 
                        'parent'        => '',   
                        'icon'          => 'fa-newspaper-o',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Blog', 
                        'link'          => 'administrator/blog', 
                        'sort'          => 7, 
                        'parent'        => '',   
                        'icon'          => 'fa-file-text-o',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Menu', 
                        'link'          => 'administrator/menu', 
                        'sort'          => 8, 
                        'parent'        => '',   
                        'icon'          => 'fa-bars',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Auth', 
                        'link'          => '', 
                        'sort'          => 9, 
                        'parent'        => '',   
                        'icon'          => 'fa-shield',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                        [ 
                            'label'         => 'User', 
                            'link'          => 'administrator/user', 
                            'sort'          => 10, 
                            'parent'        => 9,   
                            'icon'          => '',   
                            'menu_type_id'  => 1 ,
                            'type'          => 'menu',
                            'icon_color'    => '',
                            'active'        => '1',
                        ],
                        [ 
                            'label'         => 'Groups', 
                            'link'          => 'administrator/group', 
                            'sort'          => 11, 
                            'parent'        => 9,   
                            'icon'          => '',   
                            'menu_type_id'  => 1 ,
                            'type'          => 'menu',
                            'icon_color'    => '',
                            'active'        => '1',
                        ],
                        [ 
                            'label'         => 'Access', 
                            'link'          => 'administrator/access', 
                            'sort'          => 12, 
                            'parent'        => 9,   
                            'icon'          => '',   
                            'menu_type_id'  => 1 ,
                            'type'          => 'menu',
                            'icon_color'    => '',
                            'active'        => '1',
                        ],
                        [ 
                            'label'         => 'Permission', 
                            'link'          => 'administrator/permission', 
                            'sort'          => 13, 
                            'parent'        => 9,   
                            'icon'          => '',   
                            'menu_type_id'  => 1 ,
                            'type'          => 'menu',
                            'icon_color'    => '',
                            'active'        => '1',
                        ],
                        [ 
                            'label'         => 'API Keys', 
                            'link'          => 'administrator/keys', 
                            'sort'          => 14, 
                            'parent'        => 9,   
                            'icon'          => '',   
                            'menu_type_id'  => 1 ,
                            'type'          => 'menu',
                            'icon_color'    => '',
                            'active'        => '1',
                        ],

                    [ 
                        'label'         => 'Extension', 
                        'link'          => 'administrator/extension', 
                        'sort'          => 15, 
                        'parent'        => '',   
                        'icon'          => 'fa-puzzle-piece',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'OTHER', 
                        'link'          => '', 
                        'sort'          => 16, 
                        'parent'        => '',   
                        'icon'          => '',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'label',
                        'icon_color'    => '',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Settings', 
                        'link'          => 'administrator/setting', 
                        'sort'          => 17, 
                        'parent'        => '',   
                        'icon'          => 'fa-circle-o',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => 'text-red',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'Web Documentation', 
                        'link'          => 'administrator/doc/web', 
                        'sort'          => 18, 
                        'parent'        => '',   
                        'icon'          => 'fa-circle-o',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => 'text-blue',
                        'active'        => '1',
                    ],
                    [ 
                        'label'         => 'API Documentation', 
                        'link'          => 'administrator/doc/api', 
                        'sort'          => 19, 
                        'parent'        => '',   
                        'icon'          => 'fa-circle-o',   
                        'menu_type_id'  => 1 ,
                        'type'          => 'menu',
                        'icon_color'    => 'text-yellow',
                        'active'        => '1',
                    ],
                ]);


                //insert dummy data menu front
                $this->db->insert_batch('menu', [
                    [ 
                        'label'         => 'Home', 
                        'link'          => '/', 
                        'sort'          => 1, 
                        'parent'        => '',   
                        'icon'          => '',   
                        'menu_type_id'  => 2 ,
                        'type'          => 'menu',
                        'active'        => '1',
                        'icon_color'    => '',
                    ],
                    [ 
                        'label'         => 'Blog', 
                        'link'          => 'blog', 
                        'sort'          => 4, 
                        'parent'        => '',   
                        'icon'          => '',   
                        'menu_type_id'  => 2 ,
                        'type'          => 'menu',
                        'active'        => '1',
                        'icon_color'    => ''
                    ],
                    [ 
                        'label'         => 'Dashboard', 
                        'link'          => 'administrator/dashboard', 
                        'sort'          => 5, 
                        'parent'        => '',   
                        'icon'          => '',   
                        'menu_type_id'  => 2 ,
                        'type'          => 'menu',
                        'active'        => '1',
                        'icon_color'    => ''
                    ]
                ]); 

                
                //create table keys
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'user_id' => array(
                                'type' => 'INT',
                        ),
                        'key' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 40,
                        ),
                        'level' => array(
                                'type' => 'INT',
                                'constraint' => 2,
                        ),
                        'ignore_limits' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                        ),
                        'is_private_key' => array(
                                'type' => 'TINYINT',
                                'constraint' => 1,
                        ),
                        'ip_addresses' => array(
                                'type' => 'TEXT',
                                'null' => true,
                        ),
                        'date_created' => array(
                                'type' => 'TIMESTAMP',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('keys');

                
                //insert dummy data
                $this->db->insert_batch('keys', [
                    [ 
                        'key' => strtoupper(md5(generate_key())),
                        'is_private_key' => 0,
                        'date_created' => date('Y-m-d H:i:s')
                    ],
                ]);


        }

        public function down()
        {
            $tables = $this->db->query('SHOW TABLES FROM '.$this->db->database)->result(); 
            foreach ($tables as $table) {
                $tab = array_values((array)$table)[0];
                $this->dbforge->drop_table($tab);
            }   
        }
}
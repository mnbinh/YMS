<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),
        'Google' => array(
            'client_id'     => '646412942403-8piav3cv3m2j40riofjqokm0dq7mp07h.apps.googleusercontent.com',
            // client_id lấy tù bước 1
            'client_secret' => 'YZady4pHtRkJyUqvfGahXQ1F',
            // serect_key lấy tù bước 1
            'scope'         => array('userinfo_email', 'userinfo_profile'),
            //Các thông tin muôn truy cập
        )

	)

);
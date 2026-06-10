<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Validation
    |--------------------------------------------------------------------------
    */

    'created_by' => [
        'required' => 'Created by is required.',
        'integer'  => 'Created by must be an integer.',
        'exists'   => 'Selected created by user does not exist.',
    ],

    'updated_by' => [
        'required' => 'Updated by is required.',
        'integer'  => 'Updated by must be an integer.',
        'exists'   => 'Selected updated by user does not exist.',
    ],

    'is_active' => [
        'in' => 'The is active field must be either 0 or 1.',
    ],

    "exception_error" => "Something went wrong.",
    "invalid_data" => "Trying to insert invalid data.",
    "unauthenticated" => "You dont have permission.",
    "unauthorized" => "You dont have access.",

    /*
    |--------------------------------------------------------------------------
    | Login Validation
    |--------------------------------------------------------------------------
    */

    'password' => [
        'required' => 'Password is required.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Login Messages
    |--------------------------------------------------------------------------
    */

    'invalid_credentials'   => 'Invalid email address or password.',
    'logged_in'   => 'Welcome.',
    'logged_out'   => 'Goodbye.',
    'token_available'   => 'Token available.',

    /*
    |--------------------------------------------------------------------------
    | Pages Validation
    |--------------------------------------------------------------------------
    */

    'slug' => [
        'required' => 'The slug field is required.',
        'string' => 'The slug must be a valid string.',
        'max' => 'The slug may not be greater than 255 characters.',
        'unique' => 'This slug already exists.',
    ],

    'meta_title' => [
        'array' => 'The meta title must be an array.',
    ],

    'meta_description' => [
        'array' => 'The meta description must be an array.',
    ],

    'page_code' => [
        'required' => 'Page code is required.',
        'unique'     => 'This code already assigned to another page.',
        'string'   => 'Page code must be a valid string.',
        'max'      => 'Page code may not be greater than 50 characters.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pages Messages
    |--------------------------------------------------------------------------
    */

    'get_pages_list'   => 'Pages list successfully retrieved.',
    'page_not_found'   => 'Page does not exist.',
    'media_not_found'   => 'Media does not exist.',
    'get_page_details' => 'Page details successfully retrieved.',

    'add_new_page'     => 'Page added successfully.',
    'update_page'      => 'Page updated successfully.',
    'delete_page'      => 'Page deleted successfully.',


    /*
    |--------------------------------------------------------------------------
    | Sections Validation
    |--------------------------------------------------------------------------
    */

    'page_id' => [
        'required' => 'Page ID is required.',
        'integer'  => 'Page ID must be an integer.',
        'exists'   => 'Selected page does not exist.',
    ],

    'type' => [
        'required' => 'Section type is required.',
        'string'   => 'Section type must be a valid string.',
        'max'      => 'Section type may not be greater than 100 characters.',
    ],

    'title' => [
        'required' => 'Title field is required.',
        'array' => 'Title must be an array.',
    ],

    'description' => [
        'array' => 'Description must be an array.',
    ],

    'media' => [
        'file'  => 'Media must be a valid file.',
        'mimes' => 'Media must be a file of type: jpg, jpeg, png, webp, or mp4.',
        'max'   => 'Media size may not exceed 10 MB.',
    ],

    'settings' => [
        'array' => 'Settings must be an array.',
    ],

    'sort_order' => [
        'integer' => 'Sort order must be an integer.',
        'min'     => 'Sort order must be greater than or equal to 0.',
        'unique'     => 'This order already assigned to another section.',
    ],

    'section_code' => [
        'required' => 'Section code is required.',
        'unique'     => 'This code already assigned to another section.',
        'string'   => 'Section code must be a valid string.',
        'max'      => 'Section code may not be greater than 50 characters.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Section Messages
    |--------------------------------------------------------------------------
    */

    'get_sections_list' => 'Sections list successfully retrieved.',
    'section_not_found' => 'Section does not exist.',
    'get_section_details' => 'Section details successfully retrieved.',

    'add_new_section' => 'Section added successfully.',
    'update_section' => 'Section updated successfully.',
    'delete_section' => 'Section deleted successfully.',

    /*
    |--------------------------------------------------------------------------
    | Items Validation
    |--------------------------------------------------------------------------
    */

    'section_id' => [
        'required' => 'Section ID is required.',
        'integer'  => 'Section ID must be an integer.',
        'exists'   => 'Selected section does not exist.',
    ],


    'link' => [
        'url' => 'Link must be a valid URL.',
        'max' => 'Link may not be greater than 500 characters.',
    ],

    'extra_data' => [
        'array' => 'Extra data must be an array.',
    ],

    'item_code' => [
        'required' => 'Item code is required.',
        'unique'     => 'This code already assigned to another item.',
        'string'   => 'Item code must be a valid string.',
        'max'      => 'Item code may not be greater than 50 characters.',
    ],


    /*
    |--------------------------------------------------------------------------
    | Item Messages
    |--------------------------------------------------------------------------
    */

    'get_items_list' => 'Items list successfully retrieved.',
    'item_not_found' => 'Item does not exist.',
    'get_item_details' => 'Item details successfully retrieved.',

    'add_new_item' => 'Item added successfully.',
    'update_item' => 'Item updated successfully.',
    'delete_item' => 'Item deleted successfully.',

    /*
    |--------------------------------------------------------------------------
    | Blogs Validation
    |--------------------------------------------------------------------------
    */


    'excerpt' => [
        'array' => 'Excerpt must be an array.',
    ],

    'content' => [
        'required' => 'Content field is required.',
        'array'    => 'Content must be an array.',
    ],

    'seo' => [
        'array' => 'SEO data must be an array.',
    ],

    'is_published' => [
        'in' => 'Published status must be either 0 or 1.',
    ],

    'published_at' => [
        'date' => 'Published at must be a valid date.',
    ],


    /*
    |--------------------------------------------------------------------------
    | Blog Messages
    |--------------------------------------------------------------------------
    */

    'get_blogs_list' => 'Blogs list successfully retrieved.',
    'blog_not_found' => 'Blog does not exist.',
    'get_blog_details' => 'Blog details successfully retrieved.',

    'add_new_blog' => 'Blog added successfully.',
    'update_blog' => 'Blog updated successfully.',
    'delete_blog' => 'Blog deleted successfully.',

    /*
    |--------------------------------------------------------------------------
    | Careers Validation
    |--------------------------------------------------------------------------
    */

    'requirements' => [
        'array' => 'Requirements must be an array.',
    ],

    'location' => [
        'string' => 'Location must be a valid string.',
        'max'    => 'Location may not be greater than 255 characters.',
    ],

    'employment_type' => [
        'string' => 'Employment type must be a valid string.',
        'max'    => 'Employment type may not be greater than 100 characters.',
    ],

    'deadline' => [
        'date' => 'Deadline must be a valid date.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Career Messages
    |--------------------------------------------------------------------------
    */

    'get_careers_list' => 'Careers list successfully retrieved.',
    'career_not_found' => 'Career does not exist.',
    'get_career_details' => 'Career details successfully retrieved.',

    'add_new_career' => 'Career added successfully.',
    'update_career' => 'Career updated successfully.',
    'delete_career' => 'Career deleted successfully.',

    /*
    |--------------------------------------------------------------------------
    | Career Application Messages
    |--------------------------------------------------------------------------
    */

    'get_career_applications_list' => 'Career Applications list successfully retrieved.',
    'career_application_not_found' => 'Career Application does not exist.',
    'get_career_application_details' => 'Career Application details successfully retrieved.',

    /*
    |--------------------------------------------------------------------------
    | Contact Message Messages
    |--------------------------------------------------------------------------
    */

    'get_contact_messages_list' => 'Contacts messages list successfully retrieved.',
    'contact_message_not_found' => 'Contact  message does not exist.',
    'get_contact_message_details' => 'Contact  message details successfully retrieved.',

    /*
    |--------------------------------------------------------------------------
    | Settings Validation
    |--------------------------------------------------------------------------
    */

    'key' => [
        'required' => 'Key field is required.',
        'string'   => 'Key must be a valid string.',
        'max'      => 'Key may not be greater than 255 characters.',
        'unique'   => 'This key already exists.',
    ],

    'value' => [
        'array' => 'Value must be an array.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Settings Messages
    |--------------------------------------------------------------------------
    */

    'get_settings_list' => 'Settings list successfully retrieved.',
    'setting_not_found' => 'Setting does not exist.',
    'get_setting_details' => 'Setting details successfully retrieved.',

    'add_new_setting' => 'Setting added successfully.',
    'update_setting' => 'Setting updated successfully.',
    'delete_setting' => 'Setting deleted successfully.',

    /*
    |--------------------------------------------------------------------------
    | Website Messages
    |--------------------------------------------------------------------------
    */

    'home_page' => 'Pages successfully retrieved.',
    'blog_page' => 'Blogs successfully retrieved.',
    'career_page' => 'Careers successfully retrieved.',
    'apply_job' => 'Your Application Sent Successfully.',
    'contact_us' => 'Your Message Sent Successfully.',


    /*
    |--------------------------------------------------------------------------
    | Website Validation
    |--------------------------------------------------------------------------
    */

    'career_id' => [
        'required' => 'Career is required.',
        'integer'  => 'Invalid career selection.',
        'exists'   => 'Selected career does not exist.',
    ],

    'full_name' => [
        'required' => 'Full name is required.',
        'string'   => 'Full name must be a valid text.',
        'max'      => 'Full name must not exceed 255 characters.',
    ],

    'email' => [
        'required' => 'Email is required.',
        'email'    => 'Please enter a valid email address.',
        'max'      => 'Email must not exceed 255 characters.',
        'exists'   => 'Selected email address does not exist.',
    ],

    'phone' => [
        'string' => 'Phone number must be valid text.',
        'max'    => 'Phone number must not exceed 100 characters.',
    ],

    'cv_file' => [
        'required' => 'CV file is required.',
        'file'     => 'Invalid file uploaded.',
        'mimes'    => 'CV must be a PDF, DOC, or DOCX file.',
        'max'      => 'CV file must not exceed 10MB.',
    ],

    'message' => [
        'string' => 'Message must be valid text.',
        'max'    => 'Message must not exceed 5000 characters.',
    ],

    'subject' => [
        'string' => 'Message must be valid text.',
        'max'    => 'Message must not exceed 255 characters.',
    ],

];


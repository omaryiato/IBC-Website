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

    /*
    |--------------------------------------------------------------------------
    | Pages Messages
    |--------------------------------------------------------------------------
    */

    'get_pages_list'   => 'Pages list successfully retrieved.',
    'page_not_found'   => 'Page does not exist.',
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


];


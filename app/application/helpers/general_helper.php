<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function load_javascript( $filename , $in_header=false )
    {
        if( $filename == null || trim( $filename ) == '' ) return false;
        $CI =& get_instance();

        $header_name = 'js_autoload_files_header';
        $header_array = $CI->config->item($header_name);
        $footer_name = 'js_autoload_files';
        $footer_array = $CI->config->item($footer_name);

        if( $in_header )
        {
            if( array_search( $filename , $header_array ) === false )
            {
                array_push( $header_array , $filename );
                $CI->config->set_item($header_name,$header_array);
            }

            if( $key = array_search( $filename , $footer_array ) !== false )  //then take it out of the footer if it exists
            {
                unset( $footer_array[$key] );
                $CI->config->set_item($footer_name,$footer_array);
            }
        }
        else
        {
            if( array_search( $filename , $header_array ) === false && array_search( $filename , $footer_array ) === false ) //don't load in footer if already in header
            {
                array_push( $footer_array , $filename );
                $CI->config->set_item($footer_name,$footer_array);
            }
        }
    }

    /**
     * take the result of the database call and assign each variable to the library object in question
     *
     * @param   Object  the object to assign values to
     * @param   mixed[] the data array to assign shit to
     */
    function assign_array_values( &$object , $data )
    {
        foreach( (array)$data as $key=>$val )
        {
            if( preg_match( '~^[A-Za-z0-9_]+_arr$~' , $key ) )
            {
                if( trim( $val ) != '' )
                {
                    $key = preg_replace( '~^([A-Za-z0-9_]+)_arr$~' , '$1' , $key );
                    $arr = explode( '|' , $val );
                    if( !empty( $arr ) ) $object->$key = explode( '|' , $val );
                }
            }
            elseif( preg_match( '~^[A-Za-z0-9_]+_json$~' , $key ) )
            {
                if( trim( $val ) != '' )
                {
                    $key = preg_replace( '~^([A-Za-z0-9_]+)_json$~' , '$1' , $key );
                    $json = json_decode( preg_replace('/\s+/',' ', $val ) , true );
                    if( $json && !empty( $json ) ) 
                    {
                        $object->$key = $json;
                    }
                }
                else $object->$key = array();
            }
            else $object->$key = $val;
        }

        return $object;
    }


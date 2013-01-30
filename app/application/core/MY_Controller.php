<?php

class MY_Controller extends CI_Controller {

    public $vview = array();

    public function __construct() {
        parent::__construct();
    }

    /**
     * in config/routes, we define a whole bunch of potential misspellings of projects, then direct them here, 
     *  which in turn redirects them to the proper url. 
     *
     * this is dynamic enough to work for all controllers, assuming only the controller name is spelled wrong.
     */
    function alias() {
        redirect( str_replace( $this->uri->segment(1) , strtolower( get_class( $this ) ) , $this->uri->uri_string() ) );
    }

    /**
     * sets the <title> tag content
     *
     * @param string $title, required
     * @return $this, to allow for daisy chaining
     */
    protected function vtitle($title=null) {
        if( $title != null )
        //    $this->vview['title'] = ucwords( get_class( $this) );
        //else
            $this->vview['title'] = $title;

        return $this;
    }

    protected function vdescription($desc=null) {
        if( $desc != null )
            $this->vview['description'] = $desc;

        return $this;
    }

    /**
     * defines the content to display. 
     *
     * to allow for a shorthand call, this function automatically loads all other content, such as the header, footer, etc.
     * to NOT do that, simply pass FALSE as the second parameter.
     *
     * @param string $content, the main content to display
     * @param bool $display, whether or not to load and display all other views
     * 
     * @return $this, to allow for daisy chaining (only necessary if second parameter is set)
     */
    protected function vpage($content='',$display=true)
    {
        if( isset( $this->vview['content'] ) && $this->vview['content'] != '' )
            $this->vview['content'] .= $content;
        else
            $this->vview['content'] = $content;

        if( $display )
            $this->vdisplay();
        return $this;
    }

    protected function vforbidden($hidden=null,$display=true)
    {
        $this->vview['hidden'] =  $hidden != null ? $hidden : 'this';

        $this->vpage( $this->load->view('template/private',$this->vview,true) ,$display );

        return $this;
    }

    /**
     * defines the message. it will also check to see if the flashdata message is set.
     *
     * if both the parameter and the flashdarta message are set, it will append the former to the latter
     *
     * @param string $message, the optional message to display
     * @return $this
     */
    protected function vmessage($message=null)
    {
        if ($this->session->flashdata('message'))
            $this->vview['message'] = $this->session->flashdata('message');
        else $this->vview['message'] = '';

        if( $message != null )
            $this->vview['message'] .= $message;

        if( $this->vview['message'] == '' ) unset( $this->vview['message'] );

        return $this;
    }

    protected function vheader($data=array())
    {
        $this->vview['header'] = $this->load->view('template/header',array_merge($this->vview,$data),true);

        return $this;
    }

    protected function vheading($data=array())
    {
        $this->vview['heading'] = $this->load->view('template/heading',array_merge($this->vview,$data),true);

        return $this;
    }

    protected function vfooter($data=array())
    {
        $this->vview['footer'] = $this->load->view('template/footer',array_merge($this->vview,$data),true);

        return $this;
    }

    /**
     * this function should be called before displaying the views. it checks to make sure that all necessary values are set.
     *
     * @return $this
     */
    private function _vprepare()
    {
        if( !isset( $this->vview['message'] ) ) $this->vmessage();
        if( !isset( $this->vview['title'] ) ) $this->vtitle();
        if( !isset( $this->vview['header'] ) ) $this->vheader();
        if( !isset( $this->vview['heading'] ) ) $this->vheading();
        if( !isset( $this->vview['footer'] ) ) $this->vfooter();

        return $this;
    }
    
    protected function verror($error_num=404,$message=null)
    {
        unset( $this->vview['content'] );
        switch( $error_num ) {
            default:
                $error['error'] = $message != null ? $message : 'uh oh...';
                break;
        }
        $error['error_code'] = $error_num;

        if( !isset( $this->vview['title'] ) ) $this->vtitle('Error'); //this must be before vpage()

        $this->vpage( $this->load->view('template/error',$error,true) );
        echo $this->output->get_output();
        exit;
    }

    /**
     * this function actually loads the views
     */
    protected function vdisplay()
    {
        $this->_vprepare();

        $this->load->view('template/page',$this->vview);

        return true;
    }

}

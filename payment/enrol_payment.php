<?php
/*
 * This plugin is meant to do the payment processing and enrolment managing 
 * associated with the payment for courses -- i.e. if you do not pay $X.xx
 * for the course, then you cannot take the course. Currently, it would appear
 * that the best way to implement this functionality is to drop non-paying users
 * down to guest access. This will require that teachers not disable guest
 * enrolment.
 */
class block_discount extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_discount'); //This should grab the app name from the /lang/en/block_discount.php file
        
    } //End  public function init()

    public function get_content() {
        if($this->content !== null) {
            return $this->content;  //If the content is already configured, skip the rest
        }
        
        $this->content = new stdClass;
        $this->content->text = 'content';  //ToDo: add content 
        $this->content->footer = 'Footer'; //ToDo: add Footer
        
        return $this->content;
        
    } //End public function get_content()    
} //End Class

?>
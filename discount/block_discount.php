<?php
/*
 * This is meant to serve as the administrative-side discount management block. This block will
 * allow admins to input new discount codes for existing courses. This will involve the course, the 
 * code, and the discount amount. The block should also display the new price for the course, and
 * other important course information. 
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
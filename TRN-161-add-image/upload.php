<?php

class File_Upload
{
    private $folder;
    private $position;

    public function __construct($file_data)
    {
        $this->folder = $file_data;
    }


    public function display()
    {

        $this->position = 'Images/' .  basename($this->folder["name"]);

        $type = $this->folder['type'];

        if(preg_match('/Image/', $type) == 0)
        {
            return False;
        }
        else
        {
            if (move_uploaded_file($this->folder["tmp_name"], $this->position))
            {
                return basename($this->folder["name"]);
            }
            else
            {
                return "";
            }
        }
    }

}

?>

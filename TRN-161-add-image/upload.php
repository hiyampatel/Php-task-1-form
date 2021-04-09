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

            if (move_uploaded_file($this->folder["tmp_name"], $this->position))
            {
                return $this->position;
            }
            else{
                echo "File not uploaded";
            }

        }

    }

?>

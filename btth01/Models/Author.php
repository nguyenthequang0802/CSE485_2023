<?php
    class Author{
        private $ma_tgia;
        private $ten_tgia;

        /**
         * @param $ma_tgia
         * @param $ten_tgia
         */
        public function __construct($ma_tgia, $ten_tgia)
        {
            $this->ma_tgia = $ma_tgia;
            $this->ten_tgia = $ten_tgia;
        }

        /**
         * @return mixed
         */
        public function getMaTgia()
        {
            return $this->ma_tgia;
        }

        /**
         * @param mixed $ma_tgia
         */
        public function setMaTgia($ma_tgia): void
        {
            $this->ma_tgia = $ma_tgia;
        }

        /**
         * @return mixed
         */
        public function getTenTgia()
        {
            return $this->ten_tgia;
        }

        /**
         * @param mixed $ten_tgia
         */
        public function setTenTgia($ten_tgia): void
        {
            $this->ten_tgia = $ten_tgia;
        }


    }
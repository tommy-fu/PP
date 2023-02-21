<?php

namespace App\Domain\Brand\CssStylesCollection;

use App\Domain\ColorThemes\Colors;

class iPhoneXCss
{
    public function getCssString(): string
    {
        //	    box-shadow: 0px 0px 0px 11px " . Colors::make('background') . ", 0px 0px 0px 13px #F5F5F5, 0px 0px 0px 20px " . Colors::make('iphone_x-color') . ";
        return '.iphone-x {
  position: relative;
  margin: 40px auto;
  width: 260px;
  height: 564px;
  overflow: hidden;
  /* Gradient */
  border-radius: 28px;
  -webkit-backface-visibility: hidden;
  /* Device colors */
  box-shadow: 0px 0px 0px 8px ' . Colors::make('background') . ', 0px 0px 0px 14px ' . Colors::make('iphone_x-color') . ';
}

@media only screen and (min-width: 568px) {
  .iphone-x {
      width: 360px;
      height: 780px;
      border-radius: 40px;
      box-shadow: 0px 0px 0px 12px ' . Colors::make('background') . ', 0px 0px 0px 20px ' . Colors::make('iphone_x-color') . ";
  }
}

.iphone-x:before,
.iphone-x:after{
  content: '';
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}

/* Frontal camera/speaker frame */
.iphone-x:before {
  top: -1px;
  width: 56%;
  height: 24px;
  background-color: " . Colors::make('background') . ';
  border-radius: 0px 0px 24px 24px;
  z-index: 5;
}

@media only screen and (min-width: 568px) {
  .iphone-x:before {
     height: 30px;
     border-radius: 0px 0px 40px 40px;
  }
}

.iphone-x-speaker,
.iphone-x-microphone {
  position: absolute;
  display: block;
  color: transparent;
  z-index: 5;
}
  
  /* Speaker */
  .iphone-x-speaker {
    top: 0px;
    left: 46%;
    transform: translate(-42%, 6px);
    height: 6px;
    width: 15%;
    background-color: ' . Colors::make('iphone_x-color') . ';
    border-radius: 8px;
    box-shadow: inset 0px -3px 3px 0px rgba(256, 256, 256, 0.2);
  }

  @media only screen and (min-width: 568px) {
    .iphone-x-speaker {
      left: 50%;
      transform: translate(-50%, 6px);
      width: 15%;
      height: 8px;
      border-radius: 8px;
    }
  }
  
  /* Camera */
  .iphone-x-microphone {
    top: 0px;
    transform: translate(180px, 4px);
    left: -10%;
    width: 8px;
    height: 8px;
    /* Outer circle bg */
    background-color: ' . Colors::make('iphone_x-color') . ";
    border-radius: 12px;
    box-shadow: inset 0px -3px 2px 0px rgba(224, 230, 236, 0.2);
  }

  @media only screen and (min-width: 568px) {
    .iphone-x-microphone {
      left: 10%;
      width: 12px;
      height: 12px;
    }
  }


  @media only screen and (min-width: 568px) {
    .iphone-x-microphone:after {
      top: 2px;
      left: 2px;
    }
  }";
	
//	    .iphone-x-microphone:after {
//	    content: '';
//	    position: absolute;
//	    /* Inner circle bg */
//	    background-color: " . Colors::make('iphone_x-color') . ';
//    width: 6px;
//    height: 6px;
//    top: 0px;
//    left: 0px;
//    display: block;
//    border-radius: 4px;
//    /* Inner circle shadow */
//    box-shadow: inset 0px -2px 2px rgba(224, 230, 236, 0.5);
//  }
    }
}

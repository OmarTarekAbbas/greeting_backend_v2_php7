<?php

namespace App\Http\Controllers;

use App\Greetingaudio;
use App\Greetingimg;
use App\Processedimg;
use App\Processedvid;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GprocessorController extends Controller
{
   public function __construct() {
        if (!file_exists('Processed')) {
            mkdir('Processed', 0777, true);
        }
        if (!file_exists('Processed/Video')) {
            mkdir('Processed/Video', 0777, true);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function ArabicGreetingProcessor($ImageID, $Text)
    {
        $GreetingImage = Greetingimg::find($ImageID);
        //dd($GreetingImage);
        $x = intval($GreetingImage->X);

        $Angle = intval($GreetingImage->Angle);
        $FirstR = intval($GreetingImage->FirstR);
        $FirstG = intval($GreetingImage->FirstG);
        $FirstB = intval($GreetingImage->FirstB);
        $SecondR = intval($GreetingImage->SecondR);
        $SecondG = intval($GreetingImage->secondG);
        $SecondB = intval($GreetingImage->secondB);
        $MainR = intval($GreetingImage->MainR);
        $MainG = intval($GreetingImage->MainG);
        $MainB = intval($GreetingImage->MainB);

        $WordProcessor = $this->WordProcessor($Text, $GreetingImage->DefLetLength, $GreetingImage->FontSize, $GreetingImage->Y);
        $y = $WordProcessor[1];
        $FontSize = $WordProcessor[0];

        $font = public_path($GreetingImage->Font);
        require(public_path().'/I18N/Arabic.php');
        $Arabic = new \I18N_Arabic('Glyphs');
        $text = $Arabic->utf8Glyphs($Text);

        // Create the image
        $im = imagecreatefrompng(public_path($GreetingImage->path));  // so the greetingImage must png extension

        // Create some colors
        $white = imagecolorallocate($im, $FirstR, $FirstG, $FirstB);
        $grey = imagecolorallocate($im, $SecondR, $SecondG, $SecondB);
        $black = imagecolorallocate($im, $MainR, $MainG, $MainB);
        
        
        
/*
        imagettftext($im, $FontSize, $Angle, $x+1, $y+1, $white, $font, $text);
        imagettftext($im, $FontSize, $Angle, $x-1, $y-1, $grey, $font, $text);
        imagettftext($im, $FontSize, $Angle, $x, $y, $black, $font, $text);

*/


        if (mb_strlen($text) <= 10) {
            imagettftext($im, $FontSize + 7, $Angle, $x + 210, $y + 830, $black, $font, $text);
        } else {
            imagettftext($im, $FontSize + 7, $Angle, $x + 150, $y + 830, $black, $font, $text);
        }




/*
      if ($GreetingImage->occasion_id == 29  ||  $GreetingImage->occasion_id == 48  ) {  // ramadan  or laylat al gader .. new image design
            if (mb_strlen($text) <= 10) {
                imagettftext($im, $FontSize + 7, $Angle, $x + 210, $y + 830, $black, $font, $text);
            } else {
                imagettftext($im, $FontSize + 7, $Angle, $x + 150, $y + 830, $black, $font, $text);
            }
        } else {
//            imagettftext($im, $FontSize, $Angle, $x + 1, $y + 1, $white, $font, $text);
//            imagettftext($im, $FontSize, $Angle, $x - 1, $y - 1, $grey, $font, $text);
//            imagettftext($im, $FontSize, $Angle, $x, $y, $black, $font, $text);

            if (mb_strlen($text) <= 10) {
                imagettftext($im, $FontSize, $Angle, $x + 1, $y + 1, $white, $font, $text);
                imagettftext($im, $FontSize, $Angle, $x + 1, $y + 1, $black, $font, $text);
                imagettftext($im, $FontSize, $Angle, $x, $y, $black, $font, $text);
            } else {// test is long
                imagettftext($im, $FontSize, $Angle, $x + 30, $y + 7, $white, $font, $text);
                imagettftext($im, $FontSize, $Angle, $x + 30, $y + 7, $black, $font, $text);
                imagettftext($im, $FontSize, $Angle, $x + 30, $y + 7, $black, $font, $text);
            }
        }
        */
        



        $Imagename = rand(100000000000000, 999999999999999);
        $ImagePath = 'Processed/'.$Imagename.'.png';
        imagepng($im, public_path($ImagePath));

        $ProcessedImage = Processedimg::create(['greetingimg_id'=>$ImageID, 'path'=>$ImagePath]);
        $FID = rand(100, 999).$ProcessedImage->id.rand(1000000, 9999999);      
        $ProcessedImage->update(['FID'=>$FID]);
        return array($ImagePath,$FID,$ProcessedImage->id);
    }

    public function EnglishGreetingProcessor($Text, $ImageID)
    {
        $GreetingImage = Greetingimg::find($ImageID);
        $x = intval($GreetingImage->X);

        $Angle = intval($GreetingImage->Angle);
        $FirstR = intval($GreetingImage->FirstR);
        $FirstG = intval($GreetingImage->FirstG);
        $FirstB = intval($GreetingImage->FirstB);
        $SecondR = intval($GreetingImage->SecondR);
        $SecondG = intval($GreetingImage->secondG);
        $SecondB = intval($GreetingImage->secondB);
        $MainR = intval($GreetingImage->MainR);
        $MainG = intval($GreetingImage->MainG);
        $MainB = intval($GreetingImage->MainB);

        $WordProcessor = $this->WordProcessor($Text, $GreetingImage->DefLetLength, $GreetingImage->FontSize, $GreetingImage->Y);
        $y = $WordProcessor[1];
        $FontSize = $WordProcessor[0];

        $font = public_path($GreetingImage->Font);

        // Create the image
        $im = imagecreatefrompng(public_path($GreetingImage->path));

        // Create some colors
        $white = imagecolorallocate($im, $FirstR, $FirstG, $FirstB);
        $grey = imagecolorallocate($im, $SecondR, $SecondG, $SecondB);
        $black = imagecolorallocate($im, $MainR, $MainG, $MainB);

        imagettftext($im, $FontSize, $Angle, $x+1, $y+1, $white, $font, $Text);
        imagettftext($im, $FontSize, $Angle, $x-1, $y-1, $grey, $font, $Text);
        imagettftext($im, $FontSize, $Angle, $x, $y, $black, $font, $Text);

        $Imagename = rand(100000000000000, 999999999999999);
        $ImagePath = public_path('Processed/'.$Imagename.'.png');
        imagepng($im, $ImagePath);

        $ProcessedImage = Processedimg::create(['greetingimg_id'=>$ImageID, 'path'=>$ImagePath]);
        $FID = rand(100, 999).$ProcessedImage->id.rand(1000000, 9999999);
        $ProcessedImage->update(['FID'=>$FID]);
        return array($ImagePath,$FID,$ProcessedImage->id);
    }

    
    
    /************************  
     WordProcessor($Words, $DefLength, $FontSize, $Y)
     i not know the logic of that function   // emad
     *   **************************************/
    public function WordProcessor($Words, $DefLength, $FontSize, $Y)
    {
        $LetCount= mb_strlen($Words);

        $NesbetElFontSize = $DefLength * $FontSize;
        $FontSizeNew = array();
        if (($LetCount * $FontSize) > $NesbetElFontSize) {
            $FontSizeNew[0] = $NesbetElFontSize / $LetCount;
            $FontSizeNew[0] = intval($FontSizeNew[0]);
            $FontSizeNew[1] = $Y - 15;
            if ($FontSizeNew[0] < 8) {
                return false;
            } else {
                return $FontSizeNew;
            }
        } else {
            $FontSizeNew[0] = $FontSize;
            $FontSizeNew[1] = $Y;
            return $FontSizeNew;
        }
    }
    
    
   
    
    
    


    
 public function VideoProcessor($ImageID, $AudioId, $lang, $Text) {

        $video_format = '.mp4';
        require_once 'Mobile_Detect.php';
        $detect = new \Mobile_Detect;

        $check = $detect->isMobile();
        if ($check) { //  open from samrt phone
        // Check for a specific platform with the help of the magic methods:
        if ($detect->isiOS()) {  // check if device is IOS
        $video_format = '.mp4';
        } elseif ($detect->isAndroidOS()) {
        $video_format = '.mp4';  // avi
         }

   }



if ($lang == 'ar') {
            $MakeImage = $this->ArabicGreetingProcessor($ImageID, $Text);
            $Audio = Greetingaudio::find($AudioId);
            $Vidname = rand(100000000000000, 999999999999999);
            $VidPath = 'Processed/Video/' . $Vidname .$video_format;
            //exec("/usr/bin/ffmpeg -loop 1 -i '".public_path($MakeImage[0])."' -i '".public_path($Audio->path)."' -shortest -vb 20M '".public_path($VidPath)."';");
            //  exec("/usr/bin/ffmpeg -loop_input -i '".public_path($MakeImage[0])."' -i '".public_path($Audio->path)."' -shortest '".public_path($VidPath)."';");
    //  exec("/usr/bin/ffmpeg -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -acodec copy '" . public_path($VidPath) . "';");

    // ffmpeg -i image8.jpg -i sound11.mp3 -acodec copy test.avi


  //  ffmpeg -loop 1 -i image.jpg -i audio.wav -c:v libx264 -tune stillimage -c:a aac -b:a 192k -pix_fmt yuv420p -shortest out.mp4
    // exec("/usr/bin/ffmpeg -loop 1 -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -c:v libx264 -tune stillimage -c:a aac -b:a 192k -pix_fmt yuv420p -shortest '" . public_path($VidPath) . "';");

   //  ffmpeg -loop 1 -shortest -y -i image.jpg -i audio.mp3 -acodec copy -vcodec libx264 video.avi
   
 //  echo "/usr/bin/ffmpeg -loop 1 -shortest -y -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -acodec copy -vcodec libx264 '" . public_path($VidPath) . "';"  ; die;  
    
  //  exec("/usr/bin/ffmpeg -loop 1 -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -c:v libx264 -tune stillimage -c:a aac -b:a 192k -pix_fmt yuv420p -shortest '" . public_path($VidPath) . "';");
       // exec("/usr/bin/ffmpeg -loop 1  -y -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -acodec copy -vcodec libx264  -shortest '" . public_path($VidPath) . "';");
  //  exec("/usr/bin/ffmpeg -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -acodec copy '" . public_path($VidPath) . "';");
  
      exec("/usr/bin/ffmpeg -loop 1 -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -pix_fmt yuv420p -vf scale=iw:-2 -profile:v baseline -level 3.0 -shortest -threads 2   -strict -2  '" . public_path($VidPath) . "';");





    $ProcessedVid = Processedvid::create(['processedimg_id' => $MakeImage[2], 'path' => $VidPath]);
            $FID = rand(100, 999) . $ProcessedVid->id . rand(1000000, 9999999);
            $ProcessedVid->update(['FID' => $FID]);
            return array($VidPath, $FID, $ProcessedVid->id);
        } else {
            $MakeImage = $this->EnglishGreetingProcessor($ImageID, $Text);
            $Audio = Greetingaudio::find($AudioId);
            $Vidname = rand(100000000000000, 999999999999999);
            $VidPath = 'Processed/Video/' . $Vidname .$video_format;
            //exec("/usr/bin/ffmpeg -loop 1 -i '".public_path($MakeImage[0])."' -i '".public_path($Audio->path)."' -shortest -vb 20M '".public_path($VidPath)."';");
            // exec("/usr/bin/ffmpeg -loop_input -i '".public_path($MakeImage[0])."' -i '".public_path($Audio->path)."' -shortest '".public_path($VidPath)."';");
          //  exec("/usr/bin/ffmpeg -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -acodec copy '" . public_path($VidPath) . "';");

    
    //  exec("/usr/bin/ffmpeg -loop 1 -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -c:v libx264 -tune stillimage -c:a aac -b:a 192k -pix_fmt yuv420p -shortest '" . public_path($VidPath) . "';");
     //  exec("/usr/bin/ffmpeg -loop 1  -y -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -acodec copy -vcodec libx264  -shortest '" . public_path($VidPath) . "';");
       
         //  exec("/usr/bin/ffmpeg -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -acodec copy '" . public_path($VidPath) . "';");
         
             exec("/usr/bin/ffmpeg -loop 1 -i '" . public_path($MakeImage[0]) . "' -i '" . public_path($Audio->path) . "' -pix_fmt yuv420p -vf scale=iw:-2 -profile:v baseline -level 3.0 -shortest  -threads 2   -strict -2 '" . public_path($VidPath) . "';");





    $ProcessedVid = Processedvid::create(['processedimg_id' => $MakeImage[3], 'path' => $VidPath]);
            $FID = rand(100, 999) . $ProcessedVid->id . rand(1000000, 9999999);
            $ProcessedVid->update(['FID' => $FID]);
            return array($VidPath, $FID, $ProcessedVid->id);
        }
    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ReportImage;

use App\Models\DeploymentReport;

use Session;

use Auth;

class ReportImageController extends Controller
{
    //

    public function get_images()
    {
        
        

        $user_id = Auth::user()->id;
        try {
            
            $report_code = Session::get('report_code');

            $report = DeploymentReport::where('report_code', $report_code)->where('reporter_id', $user_id )->first();

 
            $images = ReportImage::where('report_id', $report->id)->get();
    
    
            return $images; 

        } catch (\Throwable $th) {
            //throw $th;

            return $images;
        }
    }

    public function store(Request $request)
    {
        # code...

            try {
                
                
                $report_code = Session::get('report_code');

                $user_id = Auth::user()->id;
        
                $report = DeploymentReport::where('report_code', $report_code)->where('reporter_id', $user_id )->first();
        
                $image = $request->file('file');
        
                $new_name = rand().".".$image->getClientOriginalExtension();
        
                $file = $image->move(public_path('report_images'), $new_name);
            } catch (\Throwable $th) {
                //throw $th;

                return $th;
            }

            try {
                //code...
                
                // $img = ReportImage::make(public_path('report_images/'.$new_name));

                // $overlay = Image::make('findhouse/images/overlay.png')->resize(650, 300);
        
                /* insert watermark at bottom-right corner with 10px offset */
                // $img->insert($overlay, 'bottom', 10, 10);

                // $img->save(public_path('vehicle_images/'.$new_name));

            } catch (\Throwable $th) {
                //throw $th;

                return $th;
            }


        // $file = $image->move(public_path('vehicle_images'), $new_name);




        try {
            //code...

                $image = ReportImage::create([
                    'report_id' => $report->id,
                    'img_path' => $new_name
                ]);

            return $image;

        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }

        

    }
}

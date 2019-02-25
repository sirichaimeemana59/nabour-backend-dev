<?php

namespace App\Http\Controllers\RootAdmin;

use Request;
use App\Http\Controllers\Controller;
use File;
use App\InvoiceFile;
use Storage;

class EditreceiptController extends Controller
{

    public function index()
    {
        return view('Editreceipt.Editreceipt');
    }


    public function create()
    {

        foreach (Request::get('attachment') as $key => $file) {
            $path = $this->createLoadBalanceDir($file['name']);
            $invoicefile = InvoiceFile::find(Request::get('id-invoice'));
            $invoicefile->name = $file['name'];
            $invoicefile->url = $path;
            $invoicefile->is_image = $file['isImage'];
            $invoicefile->original_name = $file['originalName'];
            $invoicefile->save();

        }

        return redirect('root/admin/upload_file/receipt');
    }


    public function upload () {

        $targetFolder = public_path().DIRECTORY_SEPARATOR.'upload_tmp'.DIRECTORY_SEPARATOR;
        if(!file_exists($targetFolder))
        {
            $dir = File::makeDirectory($targetFolder, 0777, true, true);
        }
        //dd($targetFolder);
        if (!empty(Request::hasFile('file'))) //originalName
        {
            $name =  md5(Request::file('file')->getFilename());//getClientOriginalName();
            $extension = Request::file('file')->getClientOriginalExtension();
            $targetName = $name.".".$extension;


            if(Request::file('file')->move($targetFolder,$targetName)) {
                //if image
                $isImage = 0;
                if(in_array($extension, ['jpeg','jpg','gif','png'])) {
                    $isImage = 1;
                    $this->reduceImgQuality($name,$extension,$targetFolder);
                }
                return response()->json([
                        'name'      => $targetName,
                        'mime'      => Request::file('file')->getClientMimeType(),
                        'oldname'   => Request::file('file')->getClientOriginalName(),
                        'isImage'   => $isImage
                    ]
                );
            }else return '';
        }
    }

    public function searchreceipt()
    {

        if (Request::get('id')) {
            $invoice = InvoiceFile::find(Request::get('id'));
            //dd($invoice);
            if ($invoice) {
                $data = '1';
            } else {
                $data = '2';
            }
        } else {
            $data = '2';
        }


        return response()->json($data);
    }

    public function createLoadBalanceDir ($name) {
        $targetFolder = public_path().DIRECTORY_SEPARATOR.'upload_tmp'.DIRECTORY_SEPARATOR;
        $folder = substr($name, 0,2);
        $pic_folder = 'bills/'.$folder;
        $directories = Storage::disk('s3')->directories('bills'); // Directory in Amazon
        if(!in_array($pic_folder, $directories))
        {
            Storage::disk('s3')->makeDirectory($pic_folder);
        }
        $full_path_upload = $pic_folder."/".$name;
        $upload = Storage::disk('s3')->put($full_path_upload, file_get_contents($targetFolder.$name), 'public');
        File::delete($targetFolder.$name);
        return $folder."/";
    }


}

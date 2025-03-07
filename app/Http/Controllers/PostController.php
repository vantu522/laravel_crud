<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        //
     
        $imageUrl = null;

        try {
            // Kiểm tra và tải ảnh
            if ($request->hasFile('image')) {
                $uploadedFile = $request->file('image');
                
                // Ghi log thông tin file
                Log::info('Thông tin file tải lên:', [
                    'name_file' => $uploadedFile->getClientOriginalName(),
                    'size' => $uploadedFile->getSize(),
                    'type_file' => $uploadedFile->getMimeType()
                ]);

                // Tải lên Cloudinary với cấu hình chi tiết
                $uploadedImage = Cloudinary::upload($uploadedFile->getRealPath(), [
                    'folder' => 'posts',
                    'resource_type' => 'image'
                ]);

                $imageUrl = $uploadedImage->getSecurePath();
            }

            // Tạo bài viết mới
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'image' => $imageUrl
            ]);

            toastr()->success("Thêm mới thành công!");
            return redirect()->route('posts.index');

        } catch (Exception $e) {
            // Ghi log và trả về lỗi chi tiết
            Log::error('Lỗi tải ảnh: ' . $e->getMessage());
            return back()->withErrors([
                'image' => 'Không thể tải ảnh. Vui lòng thử lại. Chi tiết: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
    
        $validatedData = $request->validated(); // Lấy dữ liệu đã validate từ PostRequest
    
        // Xử lý ảnh nếu có tải lên
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $uploadedImage = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'posts'
            ]);
            $validatedData['image'] = $uploadedImage->getSecurePath();
        }
    
        $post->update($validatedData);
        toastr()->success("Sửa thành công!");
    
        return redirect()->route('posts.index');
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        toastr()->success("Xoá thành công!");
        return redirect()->route('posts.index');
    }


    public function search(Request $request){
        $query = $request->input('query');
       
        $posts = Post::where('title','like',"%{$query}%")
                ->orWhere('author','like',"%{$query}%")
                ->get();

        return view('posts.index',compact('posts'));
    }

   
}

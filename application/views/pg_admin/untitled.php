<!-- testing -->
    https://www.youtube.com/watch?v=j_OyHUqIIOU
    <br>
    <form id="video_upload_form" action="">
        <label for="video_input_box">Video URL</label>
        <input type="text" name="video_url" id="video_input_box" class="form-control" placeholder="Video URL" />
        <input type="button" class="btn btn-secondary" value="Add Video" onclick="fetch_preview_konten_video(video_url.value)"/>
    </form>

    <div class="row">
      <div class="col-md-12">
        <div id="video_preview">Preview Video</div>
      </div>
    </div>

<!-- /testing -->

<script type="text/javascript">
// Used to get the video preview. But discontinued
// function fetch_preview_konten_video(url)
// {
//   console.log(url)
//   $.ajax({
//     type: 'POST',
//     url: "<?=base_url('pg_admin/materi/ajax_konten_video')?>",
//     data: { data:url },
//     success: function(response){
//       document.getElementById('video_preview').innerHTML=response;
//     }
//   });
// }
</script>
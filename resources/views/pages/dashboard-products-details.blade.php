/> 
                      </a> 
                    </div> 
                  </div> 
                @endforeach 
                <div class="col-12"> 
                  <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data"> 
                    @csrf 
                    <input type="hidden" value="{{ $product->id }}" name="products_id"> 
                    <input 
                      type="file" 
                      name="photos" 
                      id="file" 
                      style="display: none;" 
                      multiple 
                      onchange="form.submit()" 
                    /> 
                    <button 
                      type="button" 
                      class="btn btn-secondary btn-block mt-3" 
                      onclick="thisFileUpload()" 
                    > 
                      Add Photo 
                    </button> 
                  </form> 
                </div> 
              </div> 
            </div> 
          </div> 
        </div> 
      </div> 
    </div> 
  </div> 
</div> 
@endsection 
 
@push('addon-script') 
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> 
  <script> 
    function thisFileUpload() { 
      document.getElementById("file").click(); 
    } 
  </script> 
  <script> 
    CKEDITOR.replace("editor"); 
  </script> 
@endpush
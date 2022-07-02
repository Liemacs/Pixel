
<img src="{{ $product->photo }}" alt="" style="max-height:150px; max-width:170px">
<p>title: {{ $product->title }}</p><br>
<p>summary: {{ html_entity_decode($product->summary) }}</p><br>
<p>description: {!! html_entity_decode($product->description) !!}</p><br>

<p>release: {{ $product->release }}</p><br>
<p>price: $ {{ number_format($product->price, 2)}}</p><br>
<p>discount: {{ $product->discount }} %</p><br>
<p>offer price: $ {{ number_format($product->offer_price, 2)}}</p><br>
<p>category: {{ \App\Models\Category::where('id', $product->cat_id)->value('title') }}</p><br>
<p>child category: {{ \App\Models\Category::where('id', $product->child_cat_id)->value('title') }}</p><br>
<p>publisher: {{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p><br>
<p>slug: {{ $product->slug }}</p><br>

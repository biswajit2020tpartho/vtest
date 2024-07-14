<table id="table-detail" class="table table-striped">
  <!-- <tr><td colspan='2'>NO COMPONENT hidden</td></tr> -->
  <tbody>
    <tr>
      <td>Name</td>
      <td>{{ $adsdetails->title }}</td>
    </tr>
    <tr>
      <td>Category</td>
      <td>{{$adsdetails->getAdvtCategory->name}}</td>
    </tr>
    <tr>
      <td>Images</td>
      <td><img style="max-width:150px" title="" src="{{ url('/')}}/{{  $adsdetails->images }}"></td>
    </tr>
    <tr>
      <td>Price</td>
      <td>{{ $adsdetails->amount }}</td>
    </tr>
    <tr>
      <td>Country</td>
      <td>{{ $adsdetails->getAdvtCountry->country_name}}</td>
    </tr>
    <tr>
      <td>State</td>
      <td>{{ $adsdetails->getAdvtStates->state_name}}</td>
    </tr>
    <tr>
      <td>City</td>
      <td>{{ $adsdetails->getAdvtCity->city_name}}</td>
    </tr>
    <tr>
      <td>Short Description</td>
      <td>{{ $adsdetails->short_description }}</td>
    </tr>
    <tr>
      <td>Description</td>
      <td>
        {!! html_entity_decode($adsdetails->description) !!}
      </td>
    </tr>    
    <tr>
      <td>Status</td>
      <td>{{ $adsdetails->status ? 'Active' : 'Inactive' }}</td>
    </tr>
    <tr>
      <td>Expiry Date</td>
      <td>{{ $adsdetails->expair_at }}</td>
    </tr>
    <tr>
      <td>Approved</td>
      <td>
        @if($adsdetails->approved == 1)
          Yes
        @else
          No
        @endif 
      </td>
    </tr>
  </tbody>
</table>

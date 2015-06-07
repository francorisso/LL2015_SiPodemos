@foreach ( $ogtags as $key => $value )
  <meta property="og:{{ $key }}" content="{{{ $value }}}" />

@endforeach
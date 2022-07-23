@extends('layout.index')

@section('css')
<link href="frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="frontend/css/fonts.css" rel="stylesheet">
<link href="frontend/css/common.css" rel="stylesheet">
<link href="frontend/css/header.css" rel="stylesheet">
<link href="frontend/css/footer.css" rel="stylesheet">
<link href="frontend/css/form.css" rel="stylesheet">
<link href="frontend/css/widget.css" rel="stylesheet">
<link href="frontend/css/sort.css" rel="stylesheet">
<link href="frontend/css/card.css" rel="stylesheet">
@endsection
@section('content')



@endsection

@section('script')
<!------------------- JS core------------------->
<script src="frontend/js/bootstrap.bundle.min.js"></script>
<script src="frontend/js/custom.js"></script>

<!------------------- SLIDER ON MOBILE ------------------->

<script>
	function gridView() {
		document.querySelector('.grid-view').classList.add("actived")
		document.querySelector('.hor-view').classList.remove("actived")
		document.querySelector('#show-setting').classList.remove('row-cols-2', 'row-cols-md-1', 'horizontal-view')
		document.querySelector('#show-setting').classList.add('row-cols-2', 'row-cols-md-3', 'grid-view')
	}
	function horView() {
		document.querySelector('.hor-view').classList.add("actived")
		document.querySelector('.grid-view').classList.remove("actived")
		document.querySelector('#show-setting').classList.add('row-cols-2', 'row-cols-md-1', 'horizontal-view')
		document.querySelector('#show-setting').classList.remove('row-cols-2', 'row-cols-md-3', 'grid-view')
	}

	// Notification & Account Nav Vertical Click
	var testNoti = document.getElementById('review-4-phuong');
		toggleFloatingMenuClose.onclick = function() {
			var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
			var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
				return new bootstrap.Dropdown(dropdownToggleEl)
			})
		}
</script>
@endsection
jQuery(document).ready(function(){
	var $table = jQuery('#tblTeamList'),
	    $pager = jQuery('.tblPager');

	  jQuery.tablesorter.customPagerControls({
	    table          : $table,                   // point at correct table (string or jQuery object)
	    pager          : $pager,                   // pager wrapper (string or jQuery object)
	    pageSize       : '.left a',                // container for page sizes
	    currentPage    : '.right a',               // container for page selectors
	    ends           : 2,                        // number of pages to show of either end
	    aroundCurrent  : 1,                        // number of pages surrounding the current page
	    link           : '<a href="#">{page}</a>', // page element; use {page} to include the page number
	    currentClass   : 'current',                // current page class name
	    adjacentSpacer : '<span> | </span>',       // spacer for page numbers next to each other
	    distanceSpacer : '<span> &#133; <span>',   // spacer for page numbers away from each other (ellipsis = &#133;)
	    addKeyboard    : true,                     // use left,right,up,down,pageUp,pageDown,home, or end to change current page
	    pageKeyStep    : 15                        // page step to use for pageUp and pageDown
	  });

	  // initialize tablesorter & pager
	  $table
	    .tablesorter({
	      theme: 'blue',
	      sortForce: [[0,0]],
	      widgets: ['zebra', 'columns', 'filter']
	    })
	    .tablesorterPager({
	      // target the pager markup - see the HTML block below
	      container: $pager,
	      size: 10,
	      output: 'showing: {startRow} to {endRow} ({filteredRows})'
	    });

	jQuery('#filterKeyConference').on('change', function() {
  		var columns = [];
		columns[4] = this.value; // or define the array this way [ '', '', '', '', '2?%' ]
		columns[5] = jQuery('#filterKeyDivision').val();

		$table.trigger('search', [columns]);
	});

	jQuery('#filterKeyDivision').on('change', function() {
  		var columns = [];
  		columns[4] = jQuery('#filterKeyConference').val();
		columns[5] = this.value; // or define the array this way [ '', '', '', '', '2?%' ]
		$table.trigger('search', [columns]);
	});


});


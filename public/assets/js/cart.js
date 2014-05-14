function ajaxCount(instance)
{
	var target = $('.'+instance+'Count');

	$.ajax({
		url: instance+'/count'
	}).done(function(res) {
		target.addClass('alert-success');
		target.text(res);

		setTimeout(function()
		{
			target.removeClass('alert-success');
		}, 1000);
	});
}

$(document).on('click', '.btn-add', function(e)
{
	e.preventDefault();

	var link = $(this).attr('href') + 'Ajax';
	var self = $(this);

	$.ajax({
		url: link
	}).done(function(res) {
		self.removeClass('btn-info').addClass('btn-danger').removeClass('btn-add').addClass('btn-remove').text('Remove');
		self.attr('href', "cart/" + res.rowId + '/remove');

		ajaxCount('cart');
	});
});

$(document).on('click', '.wishlist-add', function(e)
{
	e.preventDefault();

	var link = $(this).attr('href') + 'Ajax';
	var self = $(this);

	$.ajax({
		url: link
	}).done(function(res) {
		self.removeClass('wishlist-add').addClass('wishlist-remove');
		self.find('i').removeClass('fa-star-o').addClass('fa-star');
		self.attr('href', "wishlist/" + res.rowId + '/remove');

		ajaxCount('wishlist');
	});
});

$(document).on('click', '.btn-remove', function(e)
{
	e.preventDefault();

	var link = $(this).attr('href') + 'Ajax';
	var self = $(this);

	$.ajax({
		url: link
	}).done(function(res) {
		if (res.message === 'success')
		{
			self.removeClass('btn-danger').addClass('btn-info').removeClass('btn-remove').addClass('btn-add').text('Add Cart');
			self.attr('href', "cart/" + res.id + '/add');

			ajaxCount('cart');
		}
	});
});

$(document).on('click', '.wishlist-remove', function(e)
{
	e.preventDefault();

	var link = $(this).attr('href') + 'Ajax';
	var self = $(this);

	$.ajax({
		url: link
	}).done(function(res) {
		if (res.message === 'success')
		{
			window.aa = res;
			self.removeClass('wishlist-remove').addClass('wishlist-add');
			self.find('i').removeClass('fa-star').addClass('fa-star-o');
			self.attr('href', "wishlist/" + res.id + '/add');

			ajaxCount('wishlist');
		}
	});
});

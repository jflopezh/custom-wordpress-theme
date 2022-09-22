jQuery(function ($) {
	/**
	 * Class Loadmore.
	 */
	class WeliaAJAX {
		/**
		 * Contructor.
		 */
		constructor() {
			this.ajaxUrl = siteConfig?.ajaxUrl ?? "";
			this.ajaxNonce = siteConfig?.ajax_nonce ?? "";
			this.filterPosts = $("#filter-posts");
			this.filterPostsCat = $("#filter-posts-cat");
			this.filterProviders = $("#filter-providers");
			this.filterProvidersLoc = $("#filter-providers-location");
			this.filterProvidersSpe = $("#filter-providers-specialty");
			this.loadMoreBtn = $("#load-more");
			this.isRequestProcessing = false;
			this.currentRequest = null;
			this.init();
		}

		init() {
			if (!this.loadMoreBtn) {
				return;
			}

			this.totalPagesCount = this.loadMoreBtn.data("max-pages");
			this.loadMoreBtn.on("click", () => this.loadMorePosts());

			this.filterPosts.on("input", () => this.loadFilteredPosts());
			this.filterPostsCat.on("input", () => this.loadFilteredPosts());
			this.filterProviders.on("input", () => this.loadFilteredProviders());
			this.filterProvidersLoc.on("change", () => this.loadFilteredProviders());
			this.filterProvidersSpe.on("change", () => this.loadFilteredProviders());
		}

		/**
		 * Load more posts.
		 *
		 * 1.Make an ajax request, by incrementing the page no. by one on each request.
		 * 2.Append new/more posts to the existing content.
		 * 3.If the response is 0 ( which means no more posts available ), remove the load-more button from DOM.
		 * Once the load-more button gets removed, the IntersectionObserverAPI callback will not be triggered, which means
		 * there will be no further ajax request since there won't be any more posts available.
		 *
		 * @return null
		 */
		loadMorePosts() {
			// Get page no from data attribute of load-more button.
			const page = this.loadMoreBtn.data("page");
			const cat = this.loadMoreBtn.data("cat");
			if (!page || this.isRequestProcessing) {
				return null;
			}

			const nextPage = parseInt(page) + 1; // Increment page count by one.
			this.isRequestProcessing = true;

			$.ajax({
				url: this.ajaxUrl,
				type: "GET",
				data: {
					page: page,
					cat: cat,
					action: "load_more",
					ajax_nonce: this.ajaxNonce,
				},
				success: (response) => {
					this.loadMoreBtn.data("page", nextPage);
					$("#posts-wrapper").append(response);
					this.removeLoadMoreIfOnLastPage(nextPage);
					this.isRequestProcessing = false;
				},
				error: (response) => {
					console.log(response);
					this.isRequestProcessing = false;
				},
			});
		}

		loadFilteredPosts() {
			if (this.isRequestProcessing) {
				this.currentRequest.abort();
			}
			
			this.isRequestProcessing = true;
			
			let container = $("#posts-wrapper");
			
			container.addClass("loading");
			
			let keyword = this.filterPosts.val();
			let category = this.filterPostsCat.val();
			
			let data = {
				simple_card: "false",
				post_type: "post",
				per_page: 10,
				page: 1,
				ajax_nonce: this.ajaxNonce,
			}
			
			if (keyword != "") {
				data.keyword = keyword;
			}
			
			if (category != "") {
				data.taxonomy = "category";
				data.term = category;
			}

			this.currentRequest = $.ajax({
				url: "/wp-json/welia-ajax/v1/blog-posts",
				type: "GET",
				data: data,
				success: (response) => {
					console.log(response);					
					container.empty();
					
					if (!response.length) {
						container.append("<h2>No posts found</h2>");
					}
					
					if (response.length == 1) {
						
					}
					
					container.append('<span class="fill tablet"></span>');
					container.append(response);
					container.removeClass("loading");
					this.isRequestProcessing = false;
				},
				error: (response) => {
					console.log("error");
					console.log(response);
					this.isRequestProcessing = false;
				},
			});
		}
		
		loadFilteredProviders() {
			if (this.isRequestProcessing) {
				this.currentRequest.abort();
			}
			
			this.isRequestProcessing = true;
			
			let container = $("#providers-wrapper");
			
			container.addClass("loading");
			
			let keyword = this.filterProviders.val();
			let location = this.filterProvidersLoc.find("option:selected").eq(0).val().toLowerCase().replace(" ", "_");
			let specialty = this.filterProvidersSpe.find("option:selected").eq(0).val();
			
			let data = {
				post_type: "provider",
				per_page: 10,
				page: 1,
				ajax_nonce: this.ajaxNonce,
			}
			
			if (keyword != "") {
				data.keyword = keyword;
			}
			
			if (location != "" && specialty != "") {
				data.key = "provider_locations";
				data.value = location;
				data.key2 = "provider_specialties";
				data.value2 = specialty;
			} else if (location != "") {
				data.key = "provider_locations";
				data.value = location;				
			} else if (specialty != "") {
				data.key = "provider_specialties";
				data.value = specialty;	
			}
			
			console.log(location);

			this.currentRequest = $.ajax({
				url: "/wp-json/welia-ajax/v1/providers",
				type: "GET",
				data: data,
				success: (response) => {
					console.log(response);					
					container.empty();
					
					if (response == 0) {
						container.append('<h3 class="not-found">No providers found.</h3>');
						container.removeClass("loading");
						this.isRequestProcessing = false;
						return;
					}
					
					if (response.length == 1) {
						
					}

					container.append(response);
					container.removeClass("loading");
					this.isRequestProcessing = false;
				},
				error: (response) => {
					console.log("error");
					console.log(response);
					this.isRequestProcessing = false;
				},
			});
		}

		/**
		 * Remove Load more Button If on last page.
		 *
		 * @param {int} nextPage New Page.
		 */
		removeLoadMoreIfOnLastPage(nextPage) {
			if (nextPage + 1 > this.totalPagesCount) {
				this.loadMoreBtn.remove();
			}
		}

	}

	new WeliaAJAX();
});

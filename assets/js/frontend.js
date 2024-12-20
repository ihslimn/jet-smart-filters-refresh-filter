( function( $ ) {

	"use strict";

	const updateGroupTimers = function( filterGroup ) {
		for ( const filter of filterGroup.filters ) {
			if ( filter.name !== 'refresh-filter' ) {
				continue;
			}

			filter.reInitRefresh();
		}
	}

	const initRefreshFilter = function() {

		JetSmartFilters.events.subscribe( 'ajaxFilters/updated', ( provider, queryId ) => {
			const filterGroup = JetSmartFilters.filterGroups[ `${provider}/${queryId}` ];

			updateGroupTimers( filterGroup );
		} );

		window.JetSmartFilters.filtersList.JetSmartFiltersRefreshFilter = 'jet-smart-filters-refresh-filter';
		window.JetSmartFilters.filters.JetSmartFiltersRefreshFilter = class JetSmartFiltersRefreshFilter extends window.JetSmartFilters.filters.BasicFilter {

			name = 'refresh-filter';
			refreshRate = 1000;
			timer = 0;

			constructor( $container ) {
				
				const $filter = $container.find( '.jet-smart-filters-refresh-filter' );
				
				super( $container, $filter );

                if ( $container.data( 'refresh-rate' ) ) {
                    this.refreshRate = $container.data( 'refresh-rate' );
                }

				this.refreshRate = parseInt( this.refreshRate );

				if ( this.refreshRate < 5 || ! isFinite( this.refreshRate ) ) {
					this.refreshRate = 5;
				}

				this.refreshRate = this.refreshRate * 1000;

				this.reInitRefresh();
			}

			refresh() {
				this.dataValue = Date.now();
				this.emitFitersApply();
			}

			reInitRefresh() {
				clearTimeout( this.timer );
				this.timer = setTimeout( this.refresh.bind( this ), this.refreshRate );
			}

			processData() {
			}

			reset() {
				// Left empty to prevent reset when clicking the Remove filters button
			}

		};

	}

	
    document.addEventListener( 'jet-smart-filters/before-init', ( e ) => {
        initRefreshFilter();
    });
	

}( jQuery ) );

jQuery.widget("daredevel.checkboxTree", {
    _allDescendantChecked: function(li) {
        return (li.find('li input:checkbox:not(:checked)').length == 0);
    },
    _create: function() {

        var t = this;
        if (this.options.collapsable) {
            this.options.collapseAnchor = (this.options.collapseImage.length > 0) ? '<img src="' + this.options.collapseImage + '" />' : '';
            this.options.expandAnchor = (this.options.expandImage.length > 0) ? '<img src="' + this.options.expandImage + '" />' : '';
            this.options.leafAnchor = (this.options.leafImage.length > 0) ? '<img src="' + this.options.leafImage + '" />' : '';

            // initialize leafs
            this.element.find("li:not(:has(ul))").each(function() {
                jQuery(this).prepend(jQuery('<span />'));
                t._markAsLeaf(jQuery(this));
            });

            // initialize checked nodes
            this.element.find("li:has(ul):has(input:checkbox:checked)").each(function() {
                jQuery(this).prepend(jQuery('<span />'));
                t.options.initializeChecked == 'collapsed' ? t.collapse(jQuery(this)) : t.expand(jQuery(this));
            });

            // initialize unchecked nodes
            this.element.find("li:has(ul):not(:has(input:checkbox:checked))").each(function() {
                jQuery(this).prepend(jQuery('<span />'));
                t.options.initializeUnchecked == 'collapsed' ? t.collapse(jQuery(this)) : t.expand(jQuery(this));
            });

            // bind collapse/expand event
            this.element.find('li span').live("click", function() {
                var li = jQuery(this).parents("li:first");

                if (li.hasClass('collapsed')) {
                    t.expand(li);
                } else

                if (li.hasClass('expanded')) {
                    t.collapse(li);
                }
            });

            // bind collapse all element event
            jQuery(this.options.collapseAllElement).bind("click", function() {
                t.collapseAll();
            });

            // bind expand all element event
            jQuery(this.options.expandAllElement).bind("click", function() {
                t.expandAll();
            });

            // bind collapse on uncheck event
            if (this.options.onUncheck.node == 'collapse') {
                this.element.find('input:checkbox:not(:checked)').live("click", function() {
                    t.collapse(jQuery(this).parents("li:first"));
                });
            } else

            // bind expand on uncheck event
            if (this.options.onUncheck.node == 'expand') {
                this.element.find('input:checkbox:not(:checked)').live("click", function() {
                    t.expand(jQuery(this).parents("li:first"));
                });
            }

            // bind collapse on check event
            if (this.options.onCheck.node == 'collapse') {
                this.element.find('input:checkbox:checked').live("click", function() {
                    t.collapse(jQuery(this).parents("li:first"));
                });
            } else

            // bind expand on check event
            if (this.options.onCheck.node == 'expand') {
                this.element.find('input:checkbox:checked').live("click", function() {
                    t.expand(jQuery(this).parents("li:first"));
                });
            }
        }

        // bind node uncheck event
        this.element.find('input:checkbox:not(:checked)').live('click', function() {
            var li = jQuery(this).parents('li:first');
            t.uncheck(li);
        });

        // bind node check event
        this.element.find('input:checkbox:checked').live('click', function() {
            var li = jQuery(this).parents('li:first');
            t.check(li);
        });

        // add essential css class
        this.element.addClass('ui-widget-daredevel-checkboxTree');

        // add jQueryUI css widget class
        this.element.addClass('ui-widget ui-widget-content');
		
    },
    _checkAncestors: function(li) {
        li.parentsUntil(".ui-widget").filter('li').find('input:checkbox:first:not(:checked)').attr('checked', true).change();
    },
    _checkDescendants: function(li) {
        li.find('li input:checkbox:not(:checked)').attr('checked', true).change();
    },
    _isRoot: function(li) {
        var parents = li.parentsUntil('.ui-widget-daredevel-checkboxTree');
        return 0 == parents.length;
    },
    _markAsCollapsed: function(li) {
        if (this.options.expandAnchor.length > 0) {
            li.children("span").html(this.options.expandAnchor);
        } else
        if (this.options.collapseUiIcon.length > 0) {
            li.children("span").removeClass(this.options.expandUiIcon).addClass('ui-icon ' + this.options.collapseUiIcon);
        }
        li.removeClass("expanded").addClass("collapsed");
    },
    _markAsExpanded: function(li) {
        if (this.options.collapseAnchor.length > 0) {
            li.children("span").html(this.options.collapseAnchor);
        } else
        if (this.options.expandUiIcon.length > 0) {
            li.children("span").removeClass(this.options.collapseUiIcon).addClass('ui-icon ' + this.options.expandUiIcon);
        }
        li.removeClass("collapsed").addClass("expanded");
    },
    _markAsLeaf: function(li) {
        if (this.options.leafAnchor.length > 0) {
            li.children("span").html(this.options.leafAnchor);
        } else
        if (this.options.leafUiIcon.length > 0) {
            li.children("span").addClass('ui-icon ' + this.options.leafUiIcon);
        }
        li.addClass("leaf");
    },
    _parentNode: function(li) {
        return li.parents('li:first');
    },
    _uncheckAncestors: function(li) {
        li.parentsUntil(".ui-widget").filter('li').find('input:checkbox:first:checked').attr('checked', false).change();
    },
    _uncheckDescendants: function(li) {
        li.find('li input:checkbox:checked').attr('checked', false).change();
    },
    _uncheckOthers: function(li) {
        li.addClass('exclude');
        li.parents('li').addClass('exclude');
        li.find('li').addClass('exclude');
        jQuery(this.element).find('li').each(function() {
            if (!jQuery(this).hasClass('exclude')) {
                jQuery(this).find('input:checkbox:first:checked').attr('checked', false).change();
            }
        });
        jQuery(this.element).find('li').removeClass('exclude');
    },
    check: function(li) {

        li.find('input:checkbox:first:not(:checked)').attr('checked', true).change();

        // handle others
        if (this.options.onCheck.others == 'check') {
            this._checkOthers(li);
        } else

        if (this.options.onCheck.others == 'uncheck') {
            this._uncheckOthers(li);
        }

        // handle descendants
        if (this.options.onCheck.descendants == 'check') {
            this._checkDescendants(li);
        } else

        if (this.options.onCheck.descendants == 'uncheck') {
            this._uncheckDescendants(li);
        }

        // handle ancestors
        if (this.options.onCheck.ancestors == 'check') {
            this._checkAncestors(li);
        } else

        if (this.options.onCheck.ancestors == 'uncheck') {
            this._uncheckAncestors(li);
        } else

        if (this.options.onCheck.ancestors == 'checkIfFull') {
            if (!this._isRoot(li) && this._allDescendantChecked(this._parentNode(li))) {
                this.check(this._parentNode(li));
            }
        }
    },
    checkAll: function() {
        jQuery(this.element).find('input:checkbox:not(:checked)').attr('checked', true).change();
    },
    collapse: function(li) {
        if (li.hasClass('collapsed') || (li.hasClass('leaf'))) {
            return;
        }

        var t = this;

        li.children("ul").hide(this.options.collapseEffect, {}, this.options.collapseDuration);

        setTimeout(function() {
            t._markAsCollapsed(li, t.options);
        }, t.options.collapseDuration);

        t._trigger('collapse', li);
    },
    collapseAll: function() {
        var t = this;
        jQuery(this.element).find('li.expanded').each(function() {
            t.collapse(jQuery(this));
        });
    },
    expand: function(li) {
        if (li.hasClass('expanded') || (li.hasClass('leaf'))) {
            return;
        }

        var t = this;

        li.children("ul").show(t.options.expandEffect, {}, t.options.expandDuration);

        setTimeout(function() {
            t._markAsExpanded(li, t.options);
        }, t.options.expandDuration);

        t._trigger('expand', li);
    },
    expandAll: function() {
        var t = this;
        jQuery(this.element).find('li.collapsed').each(function() {
            t.expand(jQuery(this));
        });
    },
    uncheck: function(li) {

        li.find('input:checkbox:first:checked').attr('checked', false).change();

        // handle others
        if (this.options.onUncheck.others == 'check') {
            this._checkOthers(li);
        } else

        if (this.options.onUncheck.others == 'uncheck') {
            this._uncheckOthers(li);
        }

        // handle descendants
        if (this.options.onUncheck.descendants == 'check') {
            this._checkDescendants(li);
        } else

        if (this.options.onUncheck.descendants == 'uncheck') {
            this._uncheckDescendants(li);
        }

        // handle ancestors
        if (this.options.onUncheck.ancestors == 'check') {
            this._checkAncestors(li);
        } else

        if (this.options.onUncheck.ancestors == 'uncheck') {
            this._uncheckAncestors(li);
        }

    },
    uncheckAll: function() {
        jQuery(this.element).find('input:checkbox:checked').attr('checked', false).change();
    },

    /**
     * Default options values
     */
    options: {
        /**
         * Defines if tree has collapse capability.
         */
        collapsable: true,
        /**
         * Defines an element of DOM that, if clicked, trigger collapseAll() method.
         * Value can be either a jQuery object or a selector string.
         * @deprecated will be removed in jquery 0.6.
         */
        collapseAllElement: '',
        /**
         * Defines duration of collapse effect in ms.
         * Works only if collapseEffect is not null.
         */
        collapseDuration: 500,
        /**
         * Defines the effect used for collapse node.
         */
        collapseEffect: 'blind',
        /**
         * Defines URL of image used for collapse anchor.
         * @deprecated will be removed in jquery 0.6.
         */
        collapseImage: '',
        /**
         * Defines jQueryUI icon class used for collapse anchor.
         */
        collapseUiIcon: 'ui-icon-triangle-1-e',
//            dataSourceType: '',
//            dataSourceUrl: '',
        /**
         * Defines an element of DOM that, if clicked, trigger expandAll() method.
         * Value can be either a jQuery object or a selector string.
         * @deprecated will be removed in jquery 0.6.
         */
        expandAllElement: '',
        /**
         * Defines duration of expand effect in ms.
         * Works only if expandEffect is not null.
         */
        expandDuration: 500,
        /**
         * Defines the effect used for expand node.
         */
        expandEffect: 'blind',
        /**
         * Defines URL of image used for expand anchor.
         * @deprecated will be removed in jquery 0.6.
         */
        expandImage: '',
        /**
         * Defines jQueryUI icon class used for expand anchor.
         */
        expandUiIcon: 'ui-icon-triangle-1-se',
        /**
         * Defines if checked node are collapsed or not at tree initializing.
         */
        initializeChecked: 'expanded', // or 'collapsed'
        /**
         * Defines if unchecked node are collapsed or not at tree initializing.
         */
        initializeUnchecked: 'expanded', // or 'collapsed'
        /**
         * Defines URL of image used for leaf anchor.
         * @deprecated will be removed in jquery 0.6.
         */
        leafImage: '',
        /**
         * Defines jQueryUI icon class used for leaf anchor.
         */
        leafUiIcon: '',
        /**
         * Defines which actions trigger when a node is checked.
         * Actions are triggered in the following order:
         * 1) node
         * 2) others
         * 3) descendants
         * 4) ancestors
         */
        onCheck: {
            /**
             * Defines action to perform on ancestors of the checked node.
             * Available values: null, 'check', 'uncheck', 'checkIfFull'.
             */
            ancestors: 'check',
            /**
             * Defines action to perform on descendants of the checked node.
             * Available values: null, 'check', 'uncheck'.
             */
            descendants: 'check',
            /**
             * Defines action to perform on checked node.
             * Available values: null, 'collapse', 'expand'.
             */
            node: '',
            /**
             * Defines action to perform on each other node (checked one excluded).
             * Available values: null, 'check', 'uncheck'.
             */
            others: ''
        },
        /**
         * Defines which actions trigger when a node is unchecked.
         * Actions are triggered in the following order:
         * 1) node
         * 2) others
         * 3) descendants
         * 4) ancestors
         */
        onUncheck: {
            /**
             * Defines action to perform on ancestors of the unchecked node.
             * Available values: null, 'check', 'uncheck'.
             */
            ancestors: '',
            /**
             * Defines action to perform on descendants of the unchecked node.
             * Available values: null, 'check', 'uncheck'.
             */
            descendants: 'uncheck',
            /**
             * Defines action to perform on unchecked node.
             * Available values: null, 'collapse', 'expand'.
             */
            node: '',
            /**
             * Defines action to perform on each other node (unchecked one excluded).
             * Available values: null, 'check', 'uncheck'.
             */
            others: ''
        }
    }

});

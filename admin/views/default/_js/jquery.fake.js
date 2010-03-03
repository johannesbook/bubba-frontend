/*
 * jQuery fake - Creates a fake copy of a jQuery object
 *
 * Copyright © 2010 Carl Fürstenberg
 *
 * Released under GPL, BSD, or MIT license.
 * ---------------------------------------------------------------------------
 *  GPL:
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Copyright (c) The Regents of the University of California.
 * All rights reserved.
 *
 * ---------------------------------------------------------------------------
 *  BSD:
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of the University nor the names of its contributors
 *    may be used to endorse or promote products derived from this software
 *    without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS"" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED.  IN NO EVENT SHALL THE REGENTS OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS
 * OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
 °* OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
 * SUCH DAMAGE.
 *
 * ---------------------------------------------------------------------------
 *  MIT:
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * ---------------------------------------------------------------------------
 *
 *  Version: 0.2
 */
jQuery.fn.extend({
		/*
		 * fake - creates a fake clone
		 *
		 */
		"fake": function( options ) {
			// we need to save our clones
			var clones = jQuery();

			options = jQuery.extend({
					"visible": true,
					"insertintodom": true,
					"className": "ui-fake",
					"wrap": "<div/>",
					"positionate": true
				}, options
			);

			jQuery(this).each(function() {
					var element = jQuery(this);
					var orig_offset = element.offset();
					var orig_width = element.outerWidth();
					var orig_height = element.outerHeight();
					var clone = element.clone();

					clone.removeAttr("id"); // shouldn"t have two objects with same ID

					// disable any possible default event
					var possibleEvents =
						"blur focus focusin focusout load resize scroll unload click dblclick "    +
						"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
						"change select submit keydown keypress keyup error";

					clone.bind( possibleEvents, function(event) {
							event.preventDefault();
							return false;
						}
					);

					clone.addClass( options.className );

					if( options.wrap ) {
						var wrap = jQuery(options.wrap);
						wrap.append(clone);
						clone.css({margin: 0});
						clone=wrap;
						wrap.css({padding: 0});
					}

					if( options.insertintodom ) {
						clone.appendTo( "body" );
					}
					clone.css({margin: 0, position: "absolute"});
					clone.find("a").css({cursor: "default"});
					if(options.positionate) {
						clone.css({
								left: orig_offset.left,
								top: orig_offset.top,
								width: orig_width,
								height: orig_height
							}
						);
					}
					if( options.visible ) {
						clone.show();
					} else {
						clone.hide();
					}

					clones = clones.add(clone);
				}
			);

			return clones;
		}
	}
);

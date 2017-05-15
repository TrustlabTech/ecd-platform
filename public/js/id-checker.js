'use strict';//Retrieved from https://github.com/picsadotcom/za-id-validator
// Converts an integer into an array of digits
function digits(e){return Array.from(e.toString&&e.toString())}/* Validates a South African ID number based on the formula from
 * http://geekswithblogs.net/willemf/archive/2005/10/30/58561.aspx
 */function validate(e){if(null===e||'undefined'==typeof e)return!1;var f=digits(e);if(13!==f.length)return!1;// Add up all the even digits (excluding the last)
var g=f.slice(0,12).reduce(function(l,m,o){return o%2?l:l+ +m},0),h=2*+f.reduce(function(l,m,o){return o%2?l+m.toString():l},''),j=g+digits(h).reduce(function(l,m){return l+ +m},0),k=10-digits(j).pop();// Concatenate all the odd digits and multiply by two
// Add `a` to the sum of all the digits in `b`
// Subtract the last digit of `c` from 10
// Validate by comparing the last digit of `d` to the last digit of the id number
return digits(k).pop()===f[12]}// export default validate;
// The MIT License (MIT)
//
// Copyright (c) 2016 Rudolf Meijering
// Copyright (c) 2016 PICSA
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.

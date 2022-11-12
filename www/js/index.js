/*
    Licensed to the Apache Software Foundation (ASF) under one
    or more contributor license agreements.  See the NOTICE file
    distributed with this work for additional information
    regarding copyright ownership.  The ASF licenses this file
    to you under the Apache License, Version 2.0 (the
    "License"); you may not use this file except in compliance
    with the License.  You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing,
    software distributed under the License is distributed on an
    "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
     KIND, either express or implied.  See the License for the
    specific language governing permissions and limitations
    under the License.
*/

var navbar = document.getElementById('nav');
var arrow = document.getElementById('arrow');
var navcontent = document.getElementById('nav-content');

var dropdown = 0;
navbar.style.cursor = 'pointer';
navbar.onclick = function() {
	if(dropdown == 0){
   navbar.classList.add("dropdown");
   document.getElementById("nav").style.height = "100%";
   arrow.classList.remove("arrow-normal");
   arrow.classList.add("arrow-change");
   navcontent.classList.remove("invisible");
   dropdown++;
	}else{
		navbar.classList.remove("dropdown");
		document.getElementById("nav").style.height = "60px";
		arrow.classList.remove("arrow-change");
		arrow.classList.add("arrow-normal");
		navcontent.classList.add("invisible");
		dropdown--;
	}
};
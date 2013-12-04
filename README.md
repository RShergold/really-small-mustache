Really Small Mustache
=====================

This is my really small php implementation of the mustache templating system. It is based on a GitHub [gist by yhirose](https://gist.github.com/yhirose/3195927). As it stands this version supports: 

#####Variables:
{{variable_name}}

#####non-escaped Variables:
{{{variable_name}}}

#####Sections: 
{{#array_of_variables}}{{variable_n}}{{\array_of_variables}}

#####Non-False Values:
{{# variable_name }}{{ variable_name }}{{\variable_name}}

#####Partials:
{{> file_name.html}}

And my own slight tweak
#####Escaped Partials:
{{1> file_name.html}}
Escaped for use in a JS string
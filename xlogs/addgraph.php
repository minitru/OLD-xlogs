<?php

// addgraph("use1_all", 600, 300);

function addgraph($name, $width, $height, $nodiv)
{
global $id;

// SMM THIS IS GROSS - GRABBING THE DATA FILE SO MANY TIMES
// I HAVE TO FIGURE OUT A WAY TO DELAY CREATING THE GRAPHS
// UNTIL THE DATA IS READY...
// echo "<script type=\"text/javascript\" src=\"cdata/$id.js\"></script>";

// IF WE DON'T GET A WIDTH PASSED DOWN WE HAVE THE DIV ABOVE
// if (! $nodiv) print "<div id=\"$name\" style=\"width:$width; height:$height;\"></div>";
print "<script type=\"text/javascript\">
      g14 = new Dygraph(
            document.getElementById(\"$name\"),
            $name, {

	labels: [ 'Date', 'instances', 'cost'],
		'cost': {
			axis: {
			}
		},
            axes: {
              y2: {
                // set axis-related properties here
	      fillGraph: true,
              }
            },
            y2AxisLabelWidth: 80,
              gridLineColor: '#00FF00',
              highlightCircleSize: 5,
		labelsSeparateLines: true,
              strokeWidth: 3
            }
          );
    </script>
";
}

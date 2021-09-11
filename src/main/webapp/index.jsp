<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Base Conversion</title>
</head>
<body>

<form method="post" action="ControllerServlet">

	<h2>Base Converter</h2>
	
	<h3 style="color: green">
	<%=  request.getAttribute("error") == null ||  request.getAttribute("error") == "" ? request.getParameter("numberToConvert") + "<sub>" + request.getParameter("fromBase") + "</sub>"+ "  = " + request.getAttribute("result") + "<sub>" +  request.getParameter("toBase") : ""  %>
	</h3>
	
	<h3 style="color: red">
	<%=  request.getAttribute("error") != null ? request.getAttribute("error") : ""  %>
	</h3>

	<label> Number to convert:</label>
	<input type="text" name="numberToConvert" value="<%= request.getParameter("numberToConvert") %>">
	<br/>
	<br/>
	<label> From Base:</label>
	<select name="fromBase">
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
		<option>10</option>
		<option>16</option>
	</select>
	
	<br/>
	<br/>
	
	<label> To Base:</label>
	<select name="toBase">
	<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
		<option>10</option>
		<option>16</option>
	</select>
	<br/>
	<br/>
	
	<input type="submit" value="Submit"/>
	
</form>

</body>
</html>
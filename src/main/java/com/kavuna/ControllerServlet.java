package com.kavuna;


import java.io.IOException;
import java.io.PrintWriter;
import java.math.BigInteger;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class ControllerServlet
 */
@WebServlet("/ControllerServlet")
public class ControllerServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public ControllerServlet() {
        super();
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		PrintWriter writer = response.getWriter();
		RequestDispatcher dispatcher = this.getServletContext().getRequestDispatcher("/index.jsp");
		try {
			
			Integer fromBase = Integer.parseInt(request.getParameter("fromBase"));
			Integer toBase = Integer.parseInt(request.getParameter("toBase"));
			BigInteger input = new BigInteger(request.getParameter("numberToConvert"), fromBase);
			request.setAttribute("result", input.toString(toBase).toUpperCase());
			dispatcher.forward(request, response);
		}
		catch(Exception exception) {
			request.setAttribute("error", request.getParameter("numberToConvert") + " is not a valid number in base " + request.getParameter("fromBase"));
			dispatcher.forward(request, response);
		}
	}
}

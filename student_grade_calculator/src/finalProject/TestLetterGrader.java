/*
 * Write a program that will determine the letter grade of students of a class	
 * using your understanding	of class (java	class),	objects, exception handling, and collection	
 * in Java.
 */
package finalProject;

import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Scanner;

class LetterGrader {
	private String inputFileName;
	private String outputFileName;
	private ArrayList<String> studentName;
	private ArrayList<Double> quiz1;
	private ArrayList<Double> quiz2;
	private ArrayList<Double> quiz3;
	private ArrayList<Double> quiz4;
	private ArrayList<Double> midterm1;
	private ArrayList<Double> midterm2;
	private ArrayList<Double> finalExam;
	private ArrayList<String> grade;
	
	/*	The two	command	line arguments: first argument will be the name of a disk file that
	 * 	contains the names of students,	and	their test scores.	The	second argument will be the 
	 * name of an output disk file
	 */
	
	LetterGrader(String inputFileName, String outputFileName) {
		this.inputFileName = inputFileName;
		this.outputFileName = outputFileName;
		studentName = new ArrayList<String>();
		quiz1 = new ArrayList<Double>();
		quiz2 = new ArrayList<Double>();
		quiz3 = new ArrayList<Double>();
		quiz4 = new ArrayList<Double>();
		midterm1 = new ArrayList<Double>();
		midterm2 = new ArrayList<Double>();
		finalExam = new ArrayList<Double>();
		grade = new ArrayList<String>();
	}
	
	//reed
	public void readScore() {
		//we have created text input file in the final Project folder manually 
		File inputFile = new File(inputFileName);
		if (!inputFile.exists()) {
			System.out.println("Input file " + inputFileName + " does not exist");
			System.exit(2);
		}
		try {
			Scanner input = new Scanner(inputFile);
			while (input.hasNextLine()) {
				String line = input.nextLine();
				// display the whole line on screen
				//System.out.println("Student #: " + i + " " + line);
				
				// this line has one students data, use split
				String[] studentInfo = line.split(",");
	
				studentName.add(studentInfo[0]);
				quiz1.add(Double.parseDouble(studentInfo[1]));
				quiz2.add(Double.parseDouble(studentInfo[2]));
				quiz3.add(Double.parseDouble(studentInfo[3]));
				quiz4.add(Double.parseDouble(studentInfo[4]));
				midterm1.add(Double.parseDouble(studentInfo[5]));
				midterm2.add(Double.parseDouble(studentInfo[6]));
				finalExam.add(Double.parseDouble(studentInfo[7]));
			}
			input.close();
		} catch (IOException e) {
			System.out.println("Error reading from input file: " + e);
		}
	}

	//calculate
	public void calcLetterGrade() {
		for (int i = 0; i < studentName.size(); i++) {
			double totalScore = quiz1.get(i) * 0.10 + quiz2.get(i) * 0.10 +
								quiz3.get(i) * 0.10	+ quiz4.get(i) * 0.10 +
								midterm1.get(i) * 0.20 + midterm2.get(i) * 0.15	+
								finalExam.get(i) * 0.25;
			if (totalScore >= 90) {
				grade.add("A");
			} else if (totalScore >= 80) {
				grade.add("B");
			} else if (totalScore >= 70) {
				grade.add("C");
			} else if (totalScore >= 60) {
				grade.add("D");
			} else {
				grade.add("F");
			}
		}		
	}

	//sort by student name
	private  void sortByNames(){
		  
	       for (int i = 0; i < studentName.size(); i++) 
	       {
	           for (int j = i + 1; j < studentName.size(); j++) 
	           {
	               if (studentName.get(i).compareTo(studentName.get(j))>0) 
	               {
	            	   String temp = studentName.get(i);
	            	   studentName.set(i,studentName.get(j));
	            	   studentName.set(j,temp);
	                   
	                 //swap scores
	                   temp = grade.get(i);
	                   grade.set(i,grade.get(j));
	                   grade.set(j,temp);
	               }
	           }
	       }
	}
	
	//The output file will have grade information of all students whose	information	was	read from	
	//input	file, in a sorted order
	public void printGrade() {
		sortByNames();
		File outputFile = new File(outputFileName);
		try {
			// output file is created and data is written on it 
			PrintWriter output = new PrintWriter(outputFile);
			output.printf("Letter grade for %d students given in '%s' file is:\n",
							  studentName.size(), inputFileName);
			output.println("");
			for (int i = 0; i < studentName.size(); i++) {
				output.println(studentName.get(i) + ":\t"+ grade.get(i));
			}
			output.close(); // close o/p file
		}catch (IOException e) {
			 System.out.println("Error writing on outputfile"+ e);
		}
	}
	
	//calculate average minimum and maximum value
	private double[] calcListStatistic(ArrayList<Double> list) {
		double sum = 0;
		double minimum = list.get(0);
		double maximum = list.get(0);
		double[] ret = new double[3];
		
		for (int i = 0; i < list.size(); i++) {
			//find Average
			sum += list.get(i);
			
			// FIND MINIMUM
			if(list.get(i)< minimum){ 
		         minimum = list.get(i); 
		      } 
			
			// FIND MAXIMUM
			if(list.get(0) > maximum){ 
		         maximum = list.get(i); 
		      } 
		}
		double average = sum/list.size();
		
		//return average, minimum, maximum 
		ret[0] = average;
		ret[1] = minimum;
		ret[2] = maximum;
		
		return ret;
	}

	//display average minimum and maximum
	public void displayAverages() {
		double[] quiz1Stats = calcListStatistic(quiz1);
		double[] quiz2Stats = calcListStatistic(quiz2);
		double[] quiz3Stats = calcListStatistic(quiz3);
		double[] quiz4Stats = calcListStatistic(quiz4);
		double[] midterm1Stats = calcListStatistic(midterm1);
		double[] midterm2Stats = calcListStatistic(midterm2);
		double[] finalExamStats = calcListStatistic(finalExam);

		System.out.println("\nLetter grade has been calculated for students listed in"
				+ " input file "+inputFileName+" and written to output file "+outputFileName);
		System.out.println("\nHere is	the class Statistic:");
		System.out.println("\n\t quiz1\tquiz2\tquiz3\tquiz4\tmidt1   midt2   final \n");
		
		System.out.println("Average: "+quiz1Stats[0]+"\t"+quiz2Stats[0]+"\t"+quiz3Stats[0]+"\t"+quiz4Stats[0]+
				"\t"+midterm1Stats[0]+"\t"+midterm2Stats[0]+"\t"+finalExamStats[0]);
		
		System.out.println("Minimum: "+quiz1Stats[1]+"\t"+quiz2Stats[1]+"\t"+quiz3Stats[1]+"\t"+quiz4Stats[1]+
				"\t"+midterm1Stats[1]+"\t"+midterm2Stats[1]+"\t"+finalExamStats[1]);
		
		System.out.println("Maximum: "+quiz1Stats[2]+"\t"+quiz2Stats[2]+"\t"+quiz3Stats[2]+"\t"+quiz4Stats[2]+
				"\t"+midterm1Stats[2]+"\t"+midterm2Stats[2]+"\t"+finalExamStats[2]);
		}
	
	public void doCleanup() {
		//for exiting after enter key is pressed(according to Example Run1)
		//exception are handled in there respective functions
		Scanner input = new Scanner(System.in);
		System.out.println("\n Press enter key to continue...");
		input.nextLine();
		input.close();
	}
}

public class TestLetterGrader {
	public	static	void	main	(String	args[])	{
		//test	if	there	are	two	valid	arguments	then,	create	the	object
		//if	not	give	right	message	and	exit
		if (args.length < 2) {
			System.out.println("USAGE: java TestLetterGrader <input_file_name> <output_file_name>");
			System.exit(1);
		}
		
		LetterGrader letterGrader =	new	LetterGrader(args[0],	args[1]);
		//LetterGrader	is	your	main	class,
		//args[0]	has	input	file	name,	and
		//args[1]	has	output	file	name
		
		letterGrader.readScore();		//reads	score and stores the data in member	variables
		letterGrader.calcLetterGrade(); //determines letter	grade and stores information
		letterGrader.printGrade();	    //writes the grade in output file
		letterGrader.displayAverages();//displays the averages in console
		letterGrader.doCleanup();	//use it to close files and other resources 
	}
}
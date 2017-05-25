
package web_db;
import java.sql.*;
import java.util.*;

public class Web_DB {
	public static void main(String[] args) throws Exception {
		String space="\n--------------";
		
		
		try{
			// Connect to database and create tables if not exist:
			Class.forName("com.mysql.jdbc.Driver");
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/books_store","root","12345678");
			
			System.out.println("Connected to the database"+space);
			
			DatabaseMetaData dbm=con.getMetaData();
			Statement s = con.createStatement();
			/////////////////////////////////////Books/////////////////////////////////////
			ResultSet tables=dbm.getTables(null, null, "books", null);
			s.executeQuery("set foreign_key_checks=0;");
			if (tables.next()) {
				
				s.executeUpdate("drop table books");
				System.out.println("'Books' table already exists ....... dropped");	
			}
			
			s.executeUpdate("create table books(bid int AUTO_INCREMENT,bname VARCHAR(50), author VARCHAR(50), year INT, price int,primary key(bid) )ENGINE=InnoDB;");
			s.executeUpdate("insert into books(bname,author,year,price) values('JavaScript','Douglas Crockford',2008 ,75)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Data and Goliath',' Bruce Schneier',2015 ,205)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Introduction to Algorithms','Thomas H. Cormen',2001 ,120)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Computer Networks',' Andrew S. Tanenbaum',2002 ,98)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Clean Code','Robert C. Martin',2008 ,112)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Design Patterns',' Erich Gamma, Ralph Johnson',1994 ,95)");
			s.executeUpdate("insert into books(bname,author,year,price) values('The C Programming Language',' Brian W. Kernighan',1988 ,130)");
			s.executeUpdate("insert into books(bname,author,year,price) values('The C++ Programming Language','Bjarne Stroustrup',2000 ,124)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Learning Python','Mark Lutz, David Ascher',2003 ,150)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Thinking in Java','Bruce Eckel',2006 ,99)");
			s.executeUpdate("insert into books(bname,author,year,price) values('In Our Own Image','George Zarkadakis',2016 ,199)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Little One','Jo Weaver',2016 ,109)");
			s.executeUpdate("insert into books(bname,author,year,price) values('The Hidden Reality','Brian Greene',2011 ,139)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Plastic',' Susan Freinkel',2011 ,144)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Poisons','Peter Macinnis',2005 ,170)");
			s.executeUpdate("insert into books(bname,author,year,price) values('Engineers of Victory','Paul Kennedy',2012 ,112)");
			
			System.out.println("\n'Books' table has been created"+space);
			/////////////////////////////////////users/////////////////////////////////////
			tables=dbm.getTables(null, null, "users", null);
			if (tables.next()) {
				s.executeUpdate("drop table users");
				System.out.println("'users' table already exists ....... dropped");
			}
			
			s.executeUpdate("create table users(uid int AUTO_INCREMENT, name VARCHAR(50), password VARCHAR(10),type VARCHAR(50), address TEXT ,phoneNumber VARCHAR(15), email VARCHAR(50), primary key(uid))ENGINE=InnoDB");
			s.executeUpdate("insert into users(name,password,type,address,phoneNumber,email) values('Emad Aghbar', '123','customer','Bilkent - 73 dorm','0599792551','e.agh@hotmail.com');");
			s.executeUpdate("insert into users(name,password,type,address,phoneNumber,email) values('Mohammed Barhm', '1234','admin','Bilkent - 76 dorm','05424337756','Mohammed@hotmail.com');");
			s.executeUpdate("insert into users(name,password,type,address,phoneNumber,email) values('Maen Mallah', '12345','manager','Bilkent - 75 dorm','05424337789','Maen@hotmail.com');");
			s.executeUpdate("insert into users(name,password,type,address,phoneNumber,email) values('Nabeel Abu Baker', '1111','manager','Bilkent','05421569321','Nabeel@hotmail.com');");
			s.executeUpdate("insert into users(name,password,type,address,phoneNumber,email) values('Fuad Amireh', '1212','customer','Bilkent','05548563218','Fuad@hotmail.com');");
			System.out.println("\n'users' table has been created"+space);
			/////////////////////////////////////store_branch/////////////////////////////////////
			tables=dbm.getTables(null, null, "store_branch", null);
			if (tables.next()) {
				s.executeUpdate("drop table store_branch");
				System.out.println("'store_branch' table already exists ....... dropped");
				
				
			}
			
			
			s.executeUpdate("create table store_branch(sid CHAR(8), sname VARCHAR(20),mid int, location VARCHAR(50),primary key(sid),foreign key (mid) references users(uid))ENGINE=InnoDB");
			s.executeUpdate("insert into store_branch values('111','Tunali',3,'Ankara - Tunali Hilmi Caddesi No:12')");
			s.executeUpdate("insert into store_branch values('112','Besiktas',4,'Istanbul - Kadirgalar Caddesi No:3')");
			s.executeUpdate("insert into store_branch values('113','Bilkent',3,'Ankara - Bilkent Center No:8 ')");
			s.executeUpdate("insert into store_branch values('114','Kadikoy',4,'Istanbul - Rihtim Caddesi No:44')");
			System.out.println("\n'store_branch' table has been created"+space);
			/////////////////////////////////////branch_has/////////////////////////////////////
			tables=dbm.getTables(null, null, "branch_has", null);
			if (tables.next()) {
				s.executeUpdate("drop table branch_has");
				System.out.println("'branch_has' table already exists ....... dropped");
			}
			
			s.executeUpdate("create table branch_has(bid int, sid CHAR(8), stock INT,primary key(bid,sid),foreign key (bid) references book(bid),foreign key (sid) references store_branch(sid))ENGINE=InnoDB");
			s.executeUpdate("insert into branch_has values(1,'111', 6)");
			s.executeUpdate("insert into branch_has values(2,'111', 4)");
			s.executeUpdate("insert into branch_has values(3,'113', 3)");
			s.executeUpdate("insert into branch_has values(4,'113', 5)");
			s.executeUpdate("insert into branch_has values(5,'113', 3)");
			s.executeUpdate("insert into branch_has values(6,'112', 4)");
			s.executeUpdate("insert into branch_has values(7,'114', 3)");
			s.executeUpdate("insert into branch_has values(8,'114', 6)");
			s.executeUpdate("insert into branch_has values(9,'111', 6)");
			s.executeUpdate("insert into branch_has values(10,'111', 4)");
			s.executeUpdate("insert into branch_has values(11,'113', 3)");
			s.executeUpdate("insert into branch_has values(12,'113', 5)");
			s.executeUpdate("insert into branch_has values(14,'113', 3)");
			s.executeUpdate("insert into branch_has values(16,'112', 4)");
			s.executeUpdate("insert into branch_has values(15,'114', 3)");
			s.executeUpdate("insert into branch_has values(13,'114', 6)");
			System.out.println("\n'branch_has' table branch_has been created"+space);
			/////////////////////////////////////customer_has/////////////////////////////////////
			tables=dbm.getTables(null, null, "customer_has", null);
			if (tables.next()) {
			s.executeUpdate("drop table customer_has");
			System.out.println("'customer_has' table already exists ....... dropped");
			}
			
			s.executeUpdate("create table customer_has(uid int, bid int, sid CHAR(8), quantity INT, dateOfPurchase DATE,primary key(bid,uid),foreign key (uid) references users(uid),foreign key (bid) references books(bid), foreign key (sid) references store_branch(sid))ENGINE=InnoDB");
			s.executeUpdate("insert into customer_has values(1, 3, '111', 1, '2012-01-01')");
			s.executeUpdate("insert into customer_has values(3, 2, '111', 3, '2012-01-01')");
			s.executeUpdate("insert into customer_has values(1, 4, '114', 2, '2012-01-01')");
			s.executeUpdate("insert into customer_has values(2, 5, '113', 1, '2012-01-01')");
			s.executeUpdate("insert into customer_has values(3, 1, '113', 1, '2012-01-01')");
			System.out.println("\n'has' table customer_has been created"+space);
			s.executeQuery("set foreign_key_checks=1;");
			System.out.println(space+"\nDatabase tables have been created"+space);
			
			ResultSet result=s.executeQuery("select * from books");
			System.out.println("\nbid\tbname\t\t\t\tauthor\t\tyear");
			System.out.println("----------------------------------------------------------------------------------");
			while (result.next()) {
				
				System.out.println(result.getString("bid")+"\t|"+result.getString("bname")+"\t|"+result.getString("author")+"\t|"+"\t"+result.getString("year"));
				
			}
		}
		catch(Exception e){
			System.out.println("OoOps , Couldn't connect to Database\n"+e);
			
		}
		
		
		
		
		
	}
}

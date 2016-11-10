using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace recordatorioPrestados
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void wb_DocumentCompleted(object sender, WebBrowserDocumentCompletedEventArgs e)
        {
            HtmlElementCollection coleccion = wb.Document.GetElementsByTagName("body");
            
            List<string> lista = new List<string>();
            List<List<string>> datos = new List<List<string>>();
            //Prestador	Fecha prestamo	Fecha devolucion	tipo prestamo	cantidad	recibidor
            DataTable dt = new DataTable();
            dt.Columns.Add("prestador");
            dt.Columns.Add("fecha_prestamo");
            dt.Columns.Add("fecha_devolucion");
            dt.Columns.Add("tipo_prestamo");
            dt.Columns.Add("cantidad");
            dt.Columns.Add("recibidor");
            dt.Columns.Add("correo_prestador");
            dt.Columns.Add("correo_recibidor");
            dt.Columns.Add("diferencia_fechas");
            foreach(HtmlElement n in coleccion)
            {
                HtmlElementCollection tabla = n.GetElementsByTagName("table");
                foreach(HtmlElement tbl in tabla)
                {
                    HtmlElementCollection trs = tbl.GetElementsByTagName("tr");

                    foreach(HtmlElement tr in trs)
                    {
                        HtmlElementCollection tds = tr.GetElementsByTagName("td");

                        foreach(HtmlElement td in tds)
                        {
                            
                            lista.Add(td.InnerText);  
                        }

                        dt.Rows.Add(lista.ToArray());
                        lista.Clear();
                        
                    }
                }
            }
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            wb.Navigate("https://prestados-ci-matialvarezs.c9.io/index.php/prestamos_pendientesc/todos");
        }
    }
}

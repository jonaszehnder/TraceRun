install.packages("ggplot2")
install.packages("dplyr")
install.packages("patchwork")
install.packages("hrbrthemes")
install.packages("ggpubr")
library(ggplot2)
library(dplyr)
library(patchwork)
library(hrbrthemes)
library(ggpubr)


cf <- 35

ggplot(SQL_File_Name, aes(x=V1, group = 1)) +
  geom_line(aes(y=V3, group = 1), size = 2, color="orange") + 
  geom_line(aes(y=V4 / cf, group = 1), size = 2, color="gray") +
  geom_line(aes(y=V6 / cf, group = 1), size = 2, color="red") +
  theme_minimal() +
  scale_y_continuous(
    name = "Distance (orange)",
    sec.axis = sec_axis(trans=~.*cf, name="Cadence (red) / Avg. Heart Rate (gray)")
  )+
  theme(
         axis.title.y = element_text(size=13),
         axis.title.y.right = element_text(size=13)
       ) +
  labs(x="Date", title="Cadence and Distance")



# D:\repository\danielfischer.bplaced.net\TraceRun\sql\selects\Charts_data
# Tests
# -----------------------------------------------------------------------------


# Anteil von I/P läufen Daniel

dataD <- data.frame(
  Legende=c("E", "I/P"),
  values=c(100-Proz_I_P_Daniel[1,1], Proz_I_P_Daniel[1,1])
)

dataY <- data.frame(
  Legende=c("E", "I/P"),
  values=c(100-Proz_I_P_Yanick[1,1], Proz_I_P_Yanick[1,1])
)

ch1 <- ggplot(dataD, aes(x="", y=values, fill=Legende))+
  geom_bar(stat="identity", width=1, color="white")+
  coord_polar("y", start=0)+
  labs(title="Anteil I/P-Läufe Daniel", fill="Lauftyp")+
  theme_void()

ch2 <- ggplot(dataY, aes(x="", y=values, fill=Legende))+
  geom_bar(stat="identity", width=1, color="white")+
  coord_polar("y", start=0)+
  labs(title="Anteil I/P-Läufe Yanick", fill="Lauftyp")+
  theme_void()

ch1 + ch2


# End Avg. Pace + Avg. Pace, Cadence and Distance
AvgPace_End_Daniel$V1 <- format(as.Date(AvgPace_End_Daniel$V1), "%m-%d")

ch3 <- ggplot(AvgPace_End_Daniel, aes(V1, V2, group = 1)) +
  geom_line(size=2, color="#292f36") +
  labs(title ="Durchschnittsgeschwindigkeit (min/km) pro Ausdauerlauf von Daniel", 
       x ="Datum", y="Durchschnittsgeschwindigkeit (min/km)")+
  geom_smooth(method = lm)+
  theme_bw()

End_Daniel_All <- data.frame(rbind(End_Daniel_30, End_Daniel_45, End_Daniel_60))
End_Daniel_All$V1 <- format(as.Date(End_Daniel_All$V1), "%m-%d")

ch4 <- ggplot(End_Daniel_All, aes(x=V1,colour=V3, group = 1)) +
  geom_line(aes(y=V4, group = 1), size = 2, color="gray") +
  geom_line(aes(y=V6, group = 1), size = 2, color="#21746f") +
  geom_point(aes(y=V6, color=V3, group = 1), size = 4) +
  scale_color_gradient(low = "#ffdf40", high = "#c40000") +
  geom_smooth(aes(y=V6),method = lm) +
  labs(x="Datum", y="Durchschnittliche Kadenz (türkis), Durchschnittliche Herzfrequenz (grau)",
       color="Distanz", title="Durchschnittliche Kadenz und Herzfrequenz pro Ausdauerlauf")+
  theme_bw()

ch3 + ch4



# Durchschnittspace aller Teilintervallen und Cadence

AvgPace_Int_All <- data.frame(rbind(AvgPace_Int_Daniel, AvgPace_Int_Yanick))
AvgPace_Int_All$V2 <- format(as.Date(AvgPace_Int_All$V2), "%m-%d")
AvgPace_Int_All[7:11,1] <- "Yanick"

ch5 <- ggplot(AvgPace_Int_All, aes(x=V2, y=V3, colour=V1, group=V1)) +
  geom_line(size=2) +
  geom_point() +
  labs(title ="Durchschnittsgeschwindigkeit (min/km) pro Teilinterval", x ="Datum", 
       y="Durchschnittsgeschwindigkeit (min/km)", col="Läufer")+
  theme_bw()

Int_StartEnd_All <- data.frame(rbind(cbind(Int_StartEnd_Daniel, V10 = "Daniel"), 
                                     cbind(Int_StartEnd_Yanick, V10 = "Yanick")))
Int_StartEnd_All$V1 <- format(as.Date(Int_StartEnd_All$V1), "%m-%d")

ch6 <- ggplot(Int_StartEnd_All, aes(fill=V1, x=V10, y=V8))+
  geom_bar(position="dodge", stat="identity")+
  coord_cartesian(ylim = c(150, NA))+
  labs(title ="Maximale Durchschnittskadenz", x ="Läufer", y="Kadenz", fill="Datum")+
  theme_bw()


ggarrange(ch5, ch6, widths=c(2,1))

# Durchschnittspace 1. Lauf und 2. Lauf der Woche

ch7 <- ggplot(AvgPace_End_FiSec_Daniel, aes(fill=V4, x=V1, y=V2))+
  geom_bar(position="dodge", stat="identity")+
  scale_fill_gradient(low = "orange", high = "darkred") +
  labs(title ="Durchschnitt der Durchschnittsgeschwindigkeit (min/km) 1. und 2. Ausdauerlauf pro Woche", x="Ausdauerlauf der Woche", y="Durchschnittsgeschwindigkeit (min/km)", fill="Kadenz")+
  theme_bw()

ch7


# Start-End Pace lauf Daniel/ Yanick

Pace_StartEnd_All <- (rbind(cbind(Pace_StartEnd_Daniel, V7 = "Daniel"),
                            cbind(Pace_StartEnd_Yanick, V7 = "Yanick")))

Pace_StartEnd_All$V1 <- format(as.Date(Pace_StartEnd_All$V1), "%m-%d")
Pace_StartEnd_All$V2 <- as.POSIXct(Pace_StartEnd_All$V2, format="%H:%M:%S")

ch8 <- ggplot(Pace_StartEnd_All, aes(x=V1, y=V2, group = V7, color=V7)) +
  geom_line(size=2) +
  labs(title ="Start- und Endlauf auf 3km", x ="Datum", y="Laufzeit (min)", color="Läufer")+
  theme_bw()

ch8


Avg_HeartRate_All <- data.frame("78  80	76	75	69	64	60
                                      80	75	70	77	66	75	77
                                      81	73	74	74	70	73	80
                                      78	81	67	66	72	66	
                                      76	70	70	64	78	76	
                                      81	69	68	70	81	74	
                                      77	68	73	81	75	70")
                                                                   
                                        
install.packages("ggplot2")
install.packages("dplyr")
install.packages("patchwork")
install.packages("hrbrthemes")
library(ggplot2)
library(dplyr)
library(patchwork)
library(hrbrthemes)


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
  labs(title="Anteil I/P-Läufe Daniel")+
  theme_void()

ch2 <- ggplot(dataY, aes(x="", y=values, fill=Legende))+
  geom_bar(stat="identity", width=1, color="white")+
  coord_polar("y", start=0)+
  labs(title="Anteil I/P-Läufe Yanick")+
  theme_void()

ch1 + ch2


# Ausdauerläufe Avg. Pace und Cadence 
AvgPace_End_Daniel$V1 <- format(as.Date(AvgPace_End_Daniel$V1), "%m-%d")

ch3 <- ggplot(AvgPace_End_Daniel, aes(V1, V2, group = 1)) +
  geom_line(size=2) +
  labs(title ="Average Pace Endurace Run", x ="Date", y="Pace (min/km)")+
  geom_smooth(method = lm)+
  theme_bw()

End_Daniel_All <- data.frame(rbind(End_Daniel_30, End_Daniel_45, End_Daniel_60))
End_Daniel_All$V1 <- format(as.Date(End_Daniel_All$V1), "%m-%d")

ch4 <- ggplot(End_Daniel_All, aes(x=V1, group = 1)) +
  geom_line(aes(y=V4, group = 1), size = 2, color="gray") +
  geom_line(aes(y=V6, group = 1), size = 2, color="red") +
  labs(x="Date", y="Cadenece (red), Avg. Heart Rate (gray)", title="Cadence and Heart Rate")+
  theme_bw()

ch3 + ch4


# Durchschnittspace aller Teilintervallen und Cadence

AvgPace_Int_All <- data.frame(rbind(AvgPace_Int_Daniel, AvgPace_Int_Yanick))
AvgPace_Int_All[7:11,1] <- "Yanick"

ch5 <- ggplot(AvgPace_Int_All, aes(x=V2, y=V3, colour=V1, group=V1)) +
  geom_line(size=2) +
  geom_point() +
  labs(title ="Average Pace per partial interval", x ="Date", 
       y="Pace (min/km)", col="Runners")+
  theme_bw()

Int_StartEnd_All <- data.frame(rbind(cbind(Int_StartEnd_Daniel, V10 = "Daniel"), 
                                     cbind(Int_StartEnd_Yanick, V10 = "Yanick")))

ch6 <- ggplot(Int_StartEnd_All, aes(fill=V1, x=V10, y=V8))+
  geom_bar(position="dodge", stat="identity")+
  coord_cartesian(ylim = c(150, NA))+
  labs(title ="Max. Avg. Cadence per partital interval", x ="Runners", y="Cadence", fill="Date")+
  theme_bw()

ch5 + ch6




install.packages("ggplot2")
install.packages("dplyr")
install.packages("patchwork")
install.packages("hrbrthemes")
library(ggplot2)
library(dplyr)
library(patchwork)
library(hrbrthemes)

ch1 <- ggplot(SQL_File_Name, aes(V1, V3, group = 1)) +
  geom_line() +
  geom_point() +
  labs(title ="Distance", x ="Date", y="Distance")+
  theme_bw()



ch2 <- ggplot(SQL_File_Name, aes(V1, V6, group = 1)) +
  geom_line() +
  geom_point() +
  labs(title ="Cadence", x ="Date", y="Cadence")+
  theme_bw()

ch1 + ch2




cf <- 35

ggplot(SQL_File_Name, aes(x=V1, group = 1)) +
  geom_line(aes(y=V3, group = 1), size = 2, color="orange") +
  geom_line(aes(y=V4 / cf, group = 1), size = 2, color="green") +
  geom_line(aes(y=V6 / cf, group = 1), size = 2, color="red") +
  theme_minimal() +
  scale_y_continuous(
    name = "Distance",
    sec.axis = sec_axis(trans=~.*cf, name="Cadence")
  )+
  theme(
    axis.title.y = element_text(color="orange", size=13),
    axis.title.y.right = element_text(color="red", size=13)
  ) +
  labs(x="Date", title="Cadence and Distance")




# Anteil von I/P läufen Daniel

data <- data.frame(
  Legend=c("I/P", "E"),
  values=c(32, 68)
)

ggplot(data, aes(x="", y=values, fill=Legend))+
  geom_bar(stat="identity", width=1, color="white")+
  coord_polar("y", start=0)+
  theme_void()
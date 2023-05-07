#!/bin/bash

echo "Starting application..."

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            UPDATE AND INSTALL"
apt-get -y update
apt-get -y install iproute2
apt-get -y install -f samba
apt-get -y install -f smbclient
# apt-get -y install samba-common
# apt-get -y install samba-common-bin
# dpkg --configure -a
# dpkg-reconfigure samba
sleep 3

Group_name=WORKGROUP
User_name=john
UserPassWord=sesecret

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            GROUPADD ${Group_name}"
groupadd ${Group_name}

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            USERADD ${User_name}"
# useradd -p sesecret -d /home/john -s /bin/bash john -g WORKGROUP
useradd -p ${UserPassWord} -d /home/${User_name} -s /bin/bash ${User_name} -g ${Group_name}
sleep 3


echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            SMBPASSWD ${User_name}"
# (echo "$UserPassWord"; echo "$UserPassWord") | smbpasswd -s -a "$User_name"
(echo "$UserPassWord"; echo "$UserPassWord") | smbpasswd -s -a ${User_name}
smbpasswd -e ${User_name}

# samba-tool user add john
# chmod 777 /srv/samba
chmod -R 0777 /home
chown -R nobody:nogroup /home

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            REPLACE SAMBA CFG"
cp /t_smb.conf /etc/samba/smb.conf

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            RESTART"
service smbd restart
service nmbd restart
service smb restart
# systemctl restart smbd
sleep 3

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            CHECK"
testparm
sleep 3
# smbclient --list //$(hostname -s)/share --user john
smbclient --list //$(hostname -s)/shared --user john
sleep 3
smbclient --list //192.168.1.1/shared --user john
# smbclient --list //$(hostname -s)/documents --user john
sleep 3

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            IP ADDRESS"
ip addr

echo " *#* *#* *#* *#* *#* *#* *#* *#* *#* *#* *#*
            SASAMBA1"
tail -f /dev/null
echo "SASAMBA2"

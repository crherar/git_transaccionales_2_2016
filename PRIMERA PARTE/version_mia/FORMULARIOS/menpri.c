#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <sys/ipc.h>
#include <sys/msg.h>
#include <sys/types.h>

struct trans
{
    int len;
    char datos[2000];
};


void proceso (char *aci, struct trans *tx_in, struct trans *tx_out,struct trans *tx_sa)
{
printf("\n\nantes de aci menpri asdasdasd \n");
strcpy(aci,"menpri00");
printf("antes de aci menpri \n");
//aci[7] = '1';
printf("DENTRO DEL MENU PRINCIPAL \n");
}

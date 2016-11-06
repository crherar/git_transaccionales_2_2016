#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/msg.h>

struct trans
{
    int len;
    char datos[2000];
};

void proceso (char *aci, struct trans *tx_in, struct trans *tx_out,struct trans *tx_sa)
{



}